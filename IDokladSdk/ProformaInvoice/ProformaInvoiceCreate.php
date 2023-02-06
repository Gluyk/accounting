<?php

namespace Accounting\IDokladSdk\ProformaInvoice;

use Webmozart\Assert\Assert;

class ProformaInvoiceCreate
{
    /**
     * @var ProformaInvoiceItem[]
     */
    private array $items = [];

    public function __construct(
        private readonly int $currencyId,
        private readonly string $dateOfIssue,
        private readonly string $dateOfMaturity,
        private readonly string $dateOfTaxing,
        private readonly string $dateOfVatApplication,
        private readonly string $description,
        private readonly int $documentSerialNumber,
        private readonly bool $isEet,
        private readonly bool $isIncomeTax,
        private readonly int $numericSequenceId,
        private readonly int $partnerId,
        private readonly int $paymentOptionId,
        private readonly ?string $dateOfPayment = null,
        private readonly ?string $accountNumber = null,
        private readonly ?int $bankId = null,
        private readonly ?string $iban = null,
        private readonly ?string $swift = null,
    ) {
        Assert::notEmpty($this->dateOfIssue, 'Date of issue can not be empty.');
        Assert::notEmpty($this->dateOfMaturity, 'Date of maturity can not be empty.');
        Assert::notEmpty($this->dateOfTaxing, 'Date of taxing can not be empty.');
        Assert::notEmpty($this->dateOfTaxing, 'Date of vat application can not be empty.');
        Assert::notEmpty($this->description, 'Description can not be empty.');
        Assert::nullOrNotEmpty($this->dateOfPayment, 'Date of payment can be null or not empty.');
        Assert::nullOrNotEmpty($this->accountNumber, 'Account number can be null or not empty.');
        Assert::nullOrNotEmpty($this->bankId, 'Bank id can be null or not empty.');
        Assert::nullOrNotEmpty($this->iban, 'Iban can be null or not empty.');
        Assert::nullOrNotEmpty($this->swift, 'Swift can be null or not empty.');
    }

    /**
     * @return ProformaInvoiceItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(ProformaInvoiceItem $payload): void
    {
        $this->items[] = $payload;
    }

    public function getCurrencyId(): int
    {
        return $this->currencyId;
    }

    public function getDateOfIssue(): string
    {
        return $this->dateOfIssue;
    }

    public function getDateOfMaturity(): string
    {
        return $this->dateOfMaturity;
    }

    public function getDateOfTaxing(): string
    {
        return $this->dateOfTaxing;
    }

    public function getDateOfVatApplication(): string
    {
        return $this->dateOfVatApplication;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDocumentSerialNumber(): int
    {
        return $this->documentSerialNumber;
    }

    public function getIsEet(): bool
    {
        return $this->isEet;
    }

    public function getIsIncomeTax(): bool
    {
        return $this->isIncomeTax;
    }

    public function getNumericSequenceId(): int
    {
        return $this->numericSequenceId;
    }

    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    public function getPaymentOptionId(): int
    {
        return $this->paymentOptionId;
    }

    public function getDateOfPayment(): ?string
    {
        return $this->dateOfPayment;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function getBankId(): ?int
    {
        return $this->bankId;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function getSwift(): ?string
    {
        return $this->swift;
    }
}
