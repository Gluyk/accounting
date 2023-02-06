<?php

namespace Accounting\IDokladSdk\Invoice;

class InvoiceItemDTO
{
    public float $amount;
    public int $id;
    public string $name;
    public ItemPriceDto $prices;
    public int $priceType;
    public float $vatRate;
    public int $vatRateType;
}
