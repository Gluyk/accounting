<?php

namespace Accounting\Configuration;

class ConfigurationParams
{
    /** @var array<string, mixed> */
    private array $params = [];

    public function add(string $key, mixed $value): void
    {
        if ($this->keyExists($key)) {
            throw new DuplicateConfigurationParamKeysException('Configuration key "' . $key . '" is a duplicate.');
        }
        $this->params[$key] = $value;
    }

    public function get(string $key): mixed
    {
        if (!$this->keyExists($key)) {
            throw new MissingConfigurationParamException('Missing "' . $key . '" config key.');
        }
        return $this->params[$key];
    }

    /**
     * @param array<string, mixed> $params
     * @return void
     * @throws DuplicateConfigurationParamKeysException
     */
    public function addBulk(array $params): void
    {
        foreach ($params as $key => $value) {
            $this->add($key, $value);
        }
    }

    private function keyExists(string $key): bool
    {
        return array_key_exists($key, $this->params);
    }
}
