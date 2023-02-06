<?php

namespace Accounting\IDokladSdk\Receipt;

use Webmozart\Assert\Assert;

class ReceiptItemCreate
{
    public function __construct(
        private readonly float $amount,
        private readonly float $discountPercentage,
        private readonly bool $isTaxMovement,
        private readonly string $name,
        private readonly int $priceType,
        private readonly float $unitPrice,
        private readonly int $vatRateType,
        private readonly string $unit,
    ) {
        Assert::greaterThan($this->amount, 0, 'Amount must be greater than 0. Got: %s');
        Assert::stringNotEmpty($this->name, 'Name can not be empty.');
        Assert::greaterThanEq($this->priceType, 0, 'Price type must be greater or equals to 0. Got: %s');
        Assert::greaterThan($this->unitPrice, 0, 'Unit price must be greater than 0. Got: %s');
        Assert::greaterThanEq($this->vatRateType, 0, 'Vat rate type must be greater or equals to 0. Got: %s');
        Assert::stringNotEmpty($this->unit, 'Unit can not be empty.');
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

    public function getUnit(): string
    {
        return $this->unit;
    }
}
