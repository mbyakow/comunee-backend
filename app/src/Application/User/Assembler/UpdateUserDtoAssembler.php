<?php

declare(strict_types=1);

namespace App\Application\User\Assembler;

use App\Application\User\Dto\UpdateUserDto;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Entity\ValueObject\UserName;

class UpdateUserDtoAssembler implements UpdateUserDtoAssemblerInterface
{
    /**
     * @inheritDoc
     */
    public function assemble(array $data): UpdateUserDto
    {
        $result = new UpdateUserDto();

        $result->id = new Id($data['id']);
        $result->email = new Email($data['email']);
        $result->userName = new UserName($data['firstName'], $data['lastName']);

        return $result;
    }
}
