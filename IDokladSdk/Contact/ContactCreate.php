<?php

namespace Accounting\IDokladSdk\Contact;

use Webmozart\Assert\Assert;

class ContactCreate
{
    public function __construct(
        private readonly string $companyName,
        private readonly int $countryId,
        private readonly string $email,
    ) {
        Assert::notEmpty($companyName, 'Company name can not be empty.');
        Assert::positiveInteger($countryId, 'Country id must be a positive integer.');
        Assert::email($email, 'Email have not a valid format.');
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
