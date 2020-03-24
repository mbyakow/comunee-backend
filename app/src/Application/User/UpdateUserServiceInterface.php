<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\UpdateUserDto;

interface UpdateUserServiceInterface
{
    /**
     * @param UpdateUserDto $updateUserDto
     */
    public function updateUser(UpdateUserDto $updateUserDto): void;
}
