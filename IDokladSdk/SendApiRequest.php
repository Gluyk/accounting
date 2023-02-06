<?php

namespace Accounting\IDokladSdk;

use Accounting\Configuration\ConfigurationParams;

class SendApiRequest
{
    /**
     * @param ConfigurationParams $configurationParams
     * @param string $requestsMethod
     * @param string $url
     * @param string $path
     * @param array<mixed> $requestBody
     */
    public function __construct(
        private readonly ConfigurationParams $configurationParams,
        private readonly string $requestsMethod,
        private readonly string $url,
        private readonly string $path,
        private readonly array $requestBody,
    ) {
    }

    public function getConfigurationParams(): ConfigurationParams
    {
        return $this->configurationParams;
    }

    public function getRequestsMethod(): string
    {
        return $this->requestsMethod;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return mixed[]
     */
    public function getRequestBody(): array
    {
        return $this->requestBody;
    }
}
