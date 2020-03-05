<?php

declare(strict_types=1);

namespace App\Domain\Entity\ValueObject;

class UserName
{
    private string $firstName;

    private string $lastName;

    /**
     * UserName constructor.
     * @param $firstName
     * @param $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
