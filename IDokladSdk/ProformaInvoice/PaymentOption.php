<?php

namespace Accounting\IDokladSdk\ProformaInvoice;

enum PaymentOption: int
{
    case BankCard = 2;
    case Cash = 3;
}
