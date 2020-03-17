<?php

declare(strict_types=1);

namespace App\Domain\Entity\User\Factory;

use App\Domain\Entity\User\User;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\UserName;

interface UserFactoryInterface
{
    /**
     * @param Email $email
     * @param UserName $userName
     * @return User
     */
    public function createUser(Email $email, UserName $userName): User;
}
