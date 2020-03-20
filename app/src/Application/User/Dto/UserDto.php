<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Entity\ValueObject\UserName;

class UserDto
{
    /** @var Id */
    public Id $id;

    /** @var UserName */
    public UserName $userName;

    /** @var Email */
    public Email $email;
}
