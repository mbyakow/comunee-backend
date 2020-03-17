<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\Exception\ValidationException;
use App\Application\User\Dto\AddUserDto;

interface AddUserServiceInterface
{
    /**
     * @param AddUserDto $addUserDto
     * @throws ValidationException
     */
    public function addUser(AddUserDto $addUserDto): void;
}
