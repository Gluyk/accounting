<?php

namespace Accounting\IDokladSdk;

use Accounting\Configuration\ConfigurationParams;
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
use Symfony\Component\Serializer\Exception\ExceptionInterface;

interface IDokladSdkInterface
{
    /**
     * @param ContactCreate $payload
     * @return ContactDTO
     * @throws ExceptionInterface
     */
    public function createContact(ContactCreate $payload): ContactDTO;

    /**
     * @return NumericSequenceDto
     * @throws ExceptionInterface
     */
    public function getNumericSequences(): NumericSequenceDto;

    /**
     * @param InvoiceCreate $payload
     * @return InvoiceDTO
     * @throws ExceptionInterface
     */
    public function createInvoice(InvoiceCreate $payload): InvoiceDTO;

    /**
     * @param InvoiceSend $payload
     * @return SentInvoiceDTO
     * @throws ExceptionInterface
     */
    public function sendInvoice(InvoiceSend $payload): SentInvoiceDTO;

    /**
     * @param ConfigurationParams $configuration
     * @return void
     */
    public function setConfiguration(ConfigurationParams $configuration): void;

    /**
     * @param ReceiptCreate $payload
     * @return ReceiptDTO
     * @throws ExceptionInterface
     */
    public function createReceipt(ReceiptCreate $payload): ReceiptDTO;

    /**
     * @param GetReceiptPdf $payload
     * @return string
     */
    public function getReceiptPdfContent(GetReceiptPdf $payload): string;

    /**
     * @param ProformaInvoiceCreate $payload
     * @return ProformaInvoiceDTO
     * @throws ExceptionInterface
     */
    public function createProformaInvoice(ProformaInvoiceCreate $payload): ProformaInvoiceDTO;

    /**
     * @param ProformaInvoiceSend $payload
     * @return SentProformaInvoiceDTO
     * @throws ExceptionInterface
     */
    public function sendProformaInvoice(ProformaInvoiceSend $payload): SentProformaInvoiceDTO;
}
