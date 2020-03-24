<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\UpdateUserDto;

interface UpdateUserDtoAssemblerInterface
{
    /**
     * @param array $data
     * @return UpdateUserDto
     */
    public function assemble(array $data): UpdateUserDto;
}
