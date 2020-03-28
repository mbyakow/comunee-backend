<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\DeactivateUserDto;

class DeactivateUserDtoAssembler implements DeactivateUserDtoAssemblerInterface
{
    /**
     * @inheritDoc
     */
    public function assemble(array $data): DeactivateUserDto
    {
        $result = new DeactivateUserDto();

        $result->id = $data['id'];

        return $result;
    }
}
