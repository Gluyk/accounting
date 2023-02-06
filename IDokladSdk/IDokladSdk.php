<?php

namespace Accounting\IDokladSdk;

use GuzzleHttp;
use Accounting\Configuration\AbstractConfiguration;
use Accounting\IDokladSdk\Contact\ContactCreate;
use Accounting\IDokladSdk\Contact\ContactDTO;
use Accounting\IDokladSdk\Invoice\InvoiceCreate;
use Accounting\IDokladSdk\Invoice\InvoiceDTO;
use Accounting\IDokladSdk\Mails\Invoice\InvoiceSend;
use Accounting\IDokladSdk\Mails\Invoice\SentInvoiceDTO;
use Accounting\IDokladSdk\Mails\ProformaInvoice\ProformaInvoiceSend;
use Accounting\IDokladSdk\Mails\ProformaInvoice\SentProformaInvoiceDTO;
use Accounting\IDokladSdk\NumericSequence\NumericSequenceDto;
use Accounting\IDokladSdk\ProformaInvoice\ProformaInvoiceCreate;
use Accounting\IDokladSdk\ProformaInvoice\ProformaInvoiceDTO;
use Accounting\IDokladSdk\Receipt\GetReceiptPdf;
use Accounting\IDokladSdk\Receipt\ReceiptCreate;
use Accounting\IDokladSdk\Receipt\ReceiptDTO;
use Accounting\NameConverter\CamelCaseToPascalCaseNameConverter;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Webmozart\Assert\Assert;

final class IDokladSdk extends AbstractConfiguration implements IDokladSdkInterface
{
    private ?string $authToken = null;

    public function __construct(
        private readonly string $apiUrl,
        private readonly string $authUrl,
        private readonly MessageBusInterface $bus,
    ) {
        Assert::allEndsWith([$apiUrl, $authUrl], '/', 'Api url and auth url must be end at slash.');
    }

    /**
     * @inheritDoc
     */
    public function createContact(ContactCreate $payload): ContactDTO
    {
        $contents = $this->sendRequest(RequestsName::CreateContact, $this->serialize($payload));

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, ContactDTO::class)->data;
    }

    /**
     * @inheritDoc
     */
    public function getNumericSequences(): NumericSequenceDto
    {
        $contents = $this->sendRequest(RequestsName::GetNumericSequences);

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, NumericSequenceDto::class)->data;
    }

    /**
     * @inheritDoc
     */
    public function createInvoice(InvoiceCreate $payload): InvoiceDTO
    {
        $contents = $this->sendRequest(RequestsName::CreateInvoice, $this->serialize($payload));

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, InvoiceDTO::class)->data;
    }

    /**
     * @inheritDoc
     */
    public function sendInvoice(InvoiceSend $payload): SentInvoiceDTO
    {
        $contents = $this->sendRequest(RequestsName::SendInvoice, $this->serialize($payload));

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, SentInvoiceDTO::class)->data;
    }

    /**
     * @inheritDoc
     */
    public function createReceipt(ReceiptCreate $payload): ReceiptDTO
    {
        $contents = $this->sendRequest(RequestsName::CreateReceipt, $this->serialize($payload));

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, ReceiptDTO::class)->data;
    }

    /**
     * @inheritDoc
     */
    public function getReceiptPdfContent(GetReceiptPdf $payload): string
    {
        $contents = $this->sendRequest(
            RequestsName::GetReceiptPdf,
            $this->serialize($payload),
            ['{id}' => (string) $payload->getReceiptId()],
        );
        $base64encodedData = $this->deserialize($contents, BaseResponseEnvelopeDTO::class)->data;

        return base64_decode($base64encodedData);
    }

    /**
     * @inheritDoc
     */
    public function createProformaInvoice(ProformaInvoiceCreate $payload): ProformaInvoiceDTO
    {
        $contents = $this->sendRequest(RequestsName::CreateProformaInvoices, $this->serialize($payload));

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, ProformaInvoiceDTO::class)->data;
    }

    /**
     * @inheritDoc
     */
    public function sendProformaInvoice(ProformaInvoiceSend $payload): SentProformaInvoiceDTO
    {
        $contents = $this->sendRequest(RequestsName::SendProformaInvoices, $this->serialize($payload));

        return $this->deserialize($contents, BaseResponseEnvelopeDTO::class, SentProformaInvoiceDTO::class)->data;
    }

    private function auth(): AuthDTO
    {
        $message = new SendAuthorizationRequest($this->getConfiguration(), $this->authUrl);
        $envelope = $this->bus->dispatch($message, [
            new AmqpStamp('idoklad-send-authorization-request', AMQP_NOPARAM),
        ]);
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $this->deserialize($handledStamp->getResult(), AuthDTO::class);
    }

    /**
     * @param RequestsName $requestsName
     * @param string|null $payload
     * @param array<string,string> $pathParams
     * @return string
     */
    private function sendRequest(
        RequestsName $requestsName,
        ?string $payload = null,
        array $pathParams = [],
    ): string {
        if ($this->authToken === null) {
            $this->authToken = $this->auth()->accessToken;
        }

        $requestBody = [
            'headers' =>
                [
                    'Authorization' => 'Bearer ' . $this->authToken,
                ],
        ];
        if ($payload !== null) {
            $requestBody[GuzzleHttp\RequestOptions::JSON] = json_decode($payload);
        }

        $path = $requestsName->value;
        foreach ($pathParams as $paramKey => $paramValue) {
            $path = str_replace($paramKey, $paramValue, $path);
        }
        $message = new SendApiRequest(
            $this->getConfiguration(),
            $requestsName->getMethod(),
            $this->apiUrl,
            $path,
            $requestBody
        );
        $envelope = $this->bus->dispatch($message, [
            new AmqpStamp('idoklad-send-api-request', AMQP_NOPARAM),
        ]);
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }

    private function serialize(object $object): string
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToPascalCaseNameConverter());
        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        return $serializer->serialize($object, JsonEncoder::FORMAT);
    }

    /**
     * @param string $json
     * @param class-string<T> $dto
     * @param string|null $dataDto
     * @return T
     * @template T
     * @throws ExceptionInterface
     */
    private function deserialize(string $json, string $dto, ?string $dataDto = null)
    {
        $extractor = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $normalizers = [
            new ObjectNormalizer(
                null,
                new CamelCaseToSnakeCaseNameConverter(),
                null,
                $extractor
            ),
            new ArrayDenormalizer(),
        ];

        $serializer = new Serializer($normalizers, [new JsonEncoder()]);

        $result = $serializer->deserialize($json, $dto, JsonEncoder::FORMAT);
        if ($dataDto !== null) {
            $result->data = $serializer->denormalize($result->data, $dataDto);
        }
        return $result;
    }
}
