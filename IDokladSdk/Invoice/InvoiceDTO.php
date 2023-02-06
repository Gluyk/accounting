<?php

namespace Accounting\IDokladSdk\Invoice;

class InvoiceDTO
{
    public int $currencyId;
    public string $dateOfAccountingEvent;
    public string $dateOfIssue;
    public string $dateOfLastReminder;
    public string $dateOfMaturity;
    public string $dateOfPayment;
    public string $dateOfTaxing;
    public string $dateOfVatApplication;
    public string $description;
    public string $documentNumber;
    public int $documentSerialNumber;
    public int $id;
    /** @var array<InvoiceItemDTO> */
    public array $items;
    public int $partnerId;
    public int $paymentOptionId;
    public int $paymentStatus;
    public string $variableSymbol;
}
