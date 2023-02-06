<?php

namespace Accounting\IDokladSdk\Invoice;

class ItemPriceDto
{
    public float $totalWithVatBeforeDiscount;
    public float $totalWithoutVatBeforeDiscount;
    public float $totalVatBeforeDiscount;
    public float $totalWithoutVat;
    public float $totalWithoutVatHc;
    public float $totalWithVat;
    public float $totalWithVatHc;
    public float $unitPrice;
    public float $totalVat;
    public float $totalVatHc;
}
