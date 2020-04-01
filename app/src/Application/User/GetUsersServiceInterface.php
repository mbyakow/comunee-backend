<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\GetUsersDto;
use App\Application\User\Dto\UserDto;

interface GetUsersServiceInterface
{
    /**
     * @param GetUsersDto $getUsersDto
     * @return UserDto[]
     */
    public function getUsers(GetUsersDto $getUsersDto): array;
}
