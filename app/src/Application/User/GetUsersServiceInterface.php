<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\UserDto;

interface GetUsersServiceInterface
{
    /**
     * @return UserDto[]
     */
    public function getUsers(): array;
}
