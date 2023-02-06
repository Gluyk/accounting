<?php

namespace Accounting\IDokladSdk\ProformaInvoice;

enum PriceType: int
{
    /** Price incl. VAT */
    case WithVat = 0;
    /** Price without VAT */
    case WithoutVat = 1;
    /** Base only */
    case OnlyBase = 2;
}
