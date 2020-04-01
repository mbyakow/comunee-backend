<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\GetUsersDto;

interface GetUsersDtoAssemblerInterface
{
    /**
     * @param array $data
     * @return GetUsersDto
     */
    public function assemble(array $data): GetUsersDto;
}
