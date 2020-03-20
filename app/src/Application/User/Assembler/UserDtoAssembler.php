<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\UserDto;
use App\Domain\Entity\User\User;

class UserDtoAssembler implements UserDtoAssemblerInterface
{
    /**
     * @inheritDoc
     */
    public function assemble(User $user): UserDto
    {
        $result = new UserDto();

        $result->id = $user->getId();
        $result->email = $user->getEmail();
        $result->userName = $user->getName();

        return $result;
    }
}
