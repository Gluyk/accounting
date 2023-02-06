<?php

namespace Accounting\IDokladSdk\Invoice;

use Webmozart\Assert\Assert;

class InvoiceItemCreate
{
    public function __construct(
        private readonly float $amount,
        private readonly float $discountPercentage,
        private readonly bool $isTaxMovement,
        private readonly string $name,
        private readonly int $priceType,
        private readonly float $unitPrice,
        private readonly int $vatRateType,
    ) {
        Assert::positiveInteger((int) $amount, 'Amount must be a positive.');
        Assert::notEmpty($name, 'Name can not be empty.');
        Assert::positiveInteger($priceType, 'Price type must be a positive.');
        Assert::positiveInteger($vatRateType, 'Vat rate type must be a positive.');
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    public function getIsTaxMovement(): bool
    {
        return $this->isTaxMovement;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPriceType(): int
    {
        return $this->priceType;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getVatRateType(): int
    {
        return $this->vatRateType;
    }
}
