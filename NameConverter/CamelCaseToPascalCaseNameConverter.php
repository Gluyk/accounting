<?php

namespace Accounting\NameConverter;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class CamelCaseToPascalCaseNameConverter implements NameConverterInterface
{
    /**
     * @inheritdoc
     */
    public function normalize(string $propertyName): string
    {
        return ucwords($propertyName);
    }

    /**
     * @inheritdoc
     */
    public function denormalize(string $propertyName): string
    {
        return lcfirst($propertyName);
    }
}
