<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\DeactivateUserDto;

interface DeactivateUserDtoAssemblerInterface
{
    /**
     * @param array $data
     * @return DeactivateUserDto
     */
    public function assemble(array $data): DeactivateUserDto;
}
