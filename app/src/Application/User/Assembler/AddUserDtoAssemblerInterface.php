<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\AddUserDto;

interface AddUserDtoAssemblerInterface
{
    /**
     * @param array $data
     * @return AddUserDto
     */
    public function assemble(array $data): AddUserDto;
}
