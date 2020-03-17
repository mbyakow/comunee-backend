<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\AddUserDto;

class AddUserDtoAssembler implements AddUserDtoAssemblerInterface
{
    /**
     * @inheritDoc
     */
    public function assemble(array $data): AddUserDto
    {
        $result = new AddUserDto();

        $result->firstName = $data['firstName'];
        $result->lastName = $data['lastName'];
        $result->email = $data['email'];

        return $result;
    }
}
