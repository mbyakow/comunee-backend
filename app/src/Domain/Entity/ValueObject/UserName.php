<?php

declare(strict_types=1);

namespace App\Domain\Entity\ValueObject;

class UserName implements \JsonSerializable
{
    /** @var string */
    private string $firstName;

    /** @var string */
    private string $lastName;

    /**
     * UserName constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function __toString(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (string)$this;
    }
}
