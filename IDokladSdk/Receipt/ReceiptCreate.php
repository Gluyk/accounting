<?php

namespace Accounting\IDokladSdk\Receipt;

use Webmozart\Assert\Assert;

class ReceiptCreate
{
    /**
     * @param int $currencyId
     * @param string $dateOfIssue
     * @param int $documentSerialNumber
     * @param string $externalDocumentNumber
     * @param bool $isCumulative
     * @param bool $isIncomeTax
     * @param string $name
     * @param string $note
     * @param ReceiptItemCreate[] $items
     * @param ReceiptPaymentCreate[] $payments
     */
    public function __construct(
        private readonly int $currencyId,
        private readonly string $dateOfIssue,
        private readonly int $documentSerialNumber,
        private readonly string $externalDocumentNumber,
        private readonly bool $isCumulative,
        private readonly bool $isIncomeTax,
        private readonly string $name,
        private readonly string $note,
        private readonly array $items,
        private readonly array $payments,
    ) {
        Assert::positiveInteger($this->currencyId, 'Currency id must be a positive integer. Got: %s');
        Assert::regex(
            $this->dateOfIssue,
            '/^\d{4}-\d{2}-\d{2}$/',
            "Date of issue value %s does not match the expected pattern of date."
        );
        Assert::positiveInteger(
            $this->documentSerialNumber,
            'Document serial number must be positive integer. Got: %s'
        );
        Assert::stringNotEmpty($this->externalDocumentNumber, 'External document number can not be empty');
        Assert::stringNotEmpty($this->name, 'Name can not be empty.');
        Assert::stringNotEmpty($this->note, 'Note can not be empty.');
        Assert::allIsInstanceOf(
            $this->items,
            ReceiptItemCreate::class,
            'Expected items to contain only instances of ReceiptItemCreate. Got: %s'
        );
        Assert::allIsInstanceOf(
            $this->payments,
            ReceiptPaymentCreate::class,
            'Expected payments to contain only instances of ReceiptPaymentCreate. Got: %s'
        );
    }

    public function getCurrencyId(): int
    {
        return $this->currencyId;
    }

    public function getDateOfIssue(): string
    {
        return $this->dateOfIssue;
    }

    public function getDocumentSerialNumber(): int
    {
        return $this->documentSerialNumber;
    }

    public function getExternalDocumentNumber(): string
    {
        return $this->externalDocumentNumber;
    }

    public function getIsCumulative(): bool
    {
        return $this->isCumulative;
    }

    public function getIsIncomeTax(): bool
    {
        return $this->isIncomeTax;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @return ReceiptItemCreate[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return ReceiptPaymentCreate[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }
}
