<?php

namespace Accounting\IDokladSdk\Invoice;

use Webmozart\Assert\Assert;

class InvoiceCreate
{
    /** @var InvoiceItemCreate[] */
    private array $items;

    public function __construct(
        private readonly int $currencyId,
        private readonly string $dateOfIssue,
        private readonly string $dateOfMaturity,
        private readonly string $dateOfTaxing,
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
        Assert::positiveInteger($currencyId, 'Currency id must be a positive integer.');
        Assert::notEmpty($description, 'Description can not be empty.');
        Assert::positiveInteger($documentSerialNumber, 'Document serial number must be positive integer.');
        Assert::positiveInteger($numericSequenceId, 'Numeric sequence id must be a positive integer.');
        Assert::positiveInteger($partnerId, 'Partner id must be a positive integer.');
        Assert::positiveInteger($paymentOptionId, 'Payment option id must be a positive integer.');
        Assert::nullOrPositiveInteger($bankId, 'Bank id can be null or can be a positive integer.');
        Assert::nullOrNotEmpty($accountNumber, 'Account number can be null or not empty.');
        Assert::nullOrNotEmpty($iban, 'Iban can be null or not empty.');
        Assert::nullOrNotEmpty($swift, 'Swift can be null or not empty.');
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

    /**
     * @return InvoiceItemCreate[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(InvoiceItemCreate $item): void
    {
        $this->items[] = $item;
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
