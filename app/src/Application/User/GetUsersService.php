<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Assembler\UserDtoAssemblerInterface;
use App\Application\User\Dto\GetUsersDto;
use App\Domain\Entity\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Service\User\Criteria\UserSearchCriteria;

class GetUsersService implements GetUsersServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /** @var UserDtoAssemblerInterface */
    private UserDtoAssemblerInterface $userDtoAssembler;

    /**
     * GetUsersService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserDtoAssemblerInterface $userDtoAssembler
     */
    public function __construct(UserRepositoryInterface $userRepository, UserDtoAssemblerInterface $userDtoAssembler)
    {
        $this->userRepository = $userRepository;
        $this->userDtoAssembler = $userDtoAssembler;
    }

    /**
     * @inheritDoc
     */
    public function getUsers(GetUsersDto $getUsersDto): array
    {
        $searchCriteria = new UserSearchCriteria();
        $searchCriteria->name = $getUsersDto->name;

        $users = $this->userRepository->findByCriteria($searchCriteria);

        return array_map(function (User $user) {
            return $this->userDtoAssembler->assemble($user);
        }, $users);
    }
}
