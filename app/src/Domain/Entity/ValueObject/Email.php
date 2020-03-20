<?php

declare(strict_types=1);

namespace App\Domain\Entity\ValueObject;

class Email implements \JsonSerializable
{
    /** @var string email */
    private string $email;

    /**
     * Email constructor.
     * @param $email
     */
    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException(sprintf('Wrong email format "%s"', $email));
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (string)$this;
    }
}
