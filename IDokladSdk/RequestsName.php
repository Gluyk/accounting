<?php

namespace Accounting\IDokladSdk;

enum RequestsName: string
{
    private const POST = 'POST';
    private const GET = 'GET';

    case CreateContact = 'Contacts';
    case GetNumericSequences = 'NumericSequences';
    case CreateInvoice = 'IssuedInvoices';
    case SendInvoice = 'Mails/IssuedInvoice/Send';
    case CreateReceipt = 'SalesReceipts';
    case GetReceiptPdf = 'Reports/SalesReceipt/{id}/Pdf?language=1';
    case CreateProformaInvoices = 'ProformaInvoices';
    case SendProformaInvoices = 'Mails/ProformaInvoice/Send';

    public function getMethod(): string
    {
        return match ($this) {
            self::CreateContact,
            self::CreateInvoice,
            self::SendInvoice,
            self::CreateReceipt,
            self::CreateProformaInvoices,
            self::SendProformaInvoices => self::POST,
            self::GetNumericSequences,
            self::GetReceiptPdf => self::GET,
        };
    }
}
