<?php

namespace Accounting\IDokladSdk\ProformaInvoice;

enum VatRateType: int
{
    /** First reduced VAT rate */
    case Reduced1 = 0;
    /** Basic sazba VAT rate */
    case Basic = 1;

    /** Zero sazba VAT rate */
    case Zero = 2;
    /** Second reduced VAT rate */
    case Reduced2 = 3;
}
