<?php

declare(strict_types=1);

namespace App\Domain\Service\User;

use App\Domain\Entity\User\User;

interface GetUserServiceInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User;
}
