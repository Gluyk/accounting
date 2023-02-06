<?php

namespace Accounting\IDokladSdk\ProformaInvoice;

use Webmozart\Assert\Assert;

class ProformaInvoiceItem
{
    public function __construct(
        private readonly float $amount,
        private readonly bool $isTaxMovement,
        private readonly string $name,
        private readonly int $priceType,
        private readonly float $unitPrice,
        private readonly int $vatRateType,
    ) {
        Assert::positiveInteger((int) $this->amount, 'Amount must be a positive.');
        Assert::notEmpty($this->name, 'Name can not be empty.');
        Assert::positiveInteger((int) $this->unitPrice, 'Unit price must be a positive.');
    }

    public function getAmount(): float
    {
        return $this->amount;
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
