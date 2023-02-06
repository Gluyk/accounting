<?php

namespace Accounting\IDokladSdk\Receipt;

use Webmozart\Assert\Assert;

class ReceiptPaymentCreate
{
    public function __construct(
        private readonly float $paymentAmount,
        private readonly int $paymentOptionId,
        private readonly string $paymentTransactionCode,
    ) {
        Assert::greaterThan($this->paymentAmount, 0, 'Payment amount must be greater than 0. Got: %s');
        Assert::positiveInteger($this->paymentOptionId, 'Payment option id must be a positive integer. Got: %s');
        Assert::stringNotEmpty(
            $this->paymentTransactionCode,
            'Expected payment transaction code to be a non-empty string'
        );
    }

    public function getPaymentAmount(): float
    {
        return $this->paymentAmount;
    }

    public function getPaymentOptionId(): int
    {
        return $this->paymentOptionId;
    }

    public function getPaymentTransactionCode(): string
    {
        return $this->paymentTransactionCode;
    }
}
