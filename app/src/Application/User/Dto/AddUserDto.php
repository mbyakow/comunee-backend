<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

class AddUserDto
{
    /** @var string */
    public string $firstName;

    /** @var string */
    public string $lastName;

    /** @var string */
    public string $email;
}
