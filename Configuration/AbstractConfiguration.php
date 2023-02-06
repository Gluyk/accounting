<?php

namespace Accounting\Configuration;

abstract class AbstractConfiguration
{
    private ConfigurationParams $configuration;

    public function getConfiguration(): ConfigurationParams
    {
        return $this->configuration;
    }

    public function setConfiguration(ConfigurationParams $configuration): void
    {
        $this->configuration = $configuration;
    }
}
