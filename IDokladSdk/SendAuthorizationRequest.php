<?php

namespace Accounting\IDokladSdk;

use Accounting\Configuration\ConfigurationParams;

class SendAuthorizationRequest
{
    public function __construct(
        private readonly ConfigurationParams $configurationParams,
        private readonly string $url,
    ) {
    }

    public function getConfigurationParams(): ConfigurationParams
    {
        return $this->configurationParams;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
