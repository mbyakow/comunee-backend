<?php

declare(strict_types=1);

namespace App\Domain\Entity\ValueObject;

use DomainException;
use JsonSerializable;

class Id implements JsonSerializable
{
    /** @var string */
    private string $value;

    /**
     * Id constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new DomainException('Id value must not be empty');
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
