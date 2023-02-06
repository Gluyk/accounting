<?php

namespace Accounting\IDokladSdk\Receipt;

use Webmozart\Assert\Assert;

class GetReceiptPdf
{
    public function __construct(
        private readonly int $receiptId,
    ) {
        Assert::positiveInteger($this->receiptId, 'Expected receipt id to be a positive integer. Got: %s.');
    }

    public function getReceiptId(): int
    {
        return $this->receiptId;
    }
}
