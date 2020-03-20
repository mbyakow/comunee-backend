<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\UserDto;
use App\Domain\Entity\User\User;

interface UserDtoAssemblerInterface
{
    /**
     * @param User $user
     * @return UserDto
     */
    public function assemble(User $user): UserDto;
}
