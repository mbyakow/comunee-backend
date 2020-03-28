<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\DeactivateUserDto;

interface DeactivateUserServiceInterface
{
    /**
     * @param DeactivateUserDto $deactivateUserDto
     */
    public function deactivateUser(DeactivateUserDto $deactivateUserDto): void;
}
