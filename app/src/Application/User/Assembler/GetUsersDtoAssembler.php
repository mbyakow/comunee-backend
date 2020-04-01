<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\GetUsersDto;

class GetUsersDtoAssembler implements GetUsersDtoAssemblerInterface
{
    /**
     * @inheritDoc
     */
    public function assemble(array $data): GetUsersDto
    {
        $result = new GetUsersDto();

        $result->name = $data['name'] ?? '';

        return $result;
    }
}
