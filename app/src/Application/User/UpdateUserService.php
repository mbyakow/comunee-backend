<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\UpdateUserDto;
use App\Domain\Repository\UserRepositoryInterface;

class UpdateUserService implements UpdateUserServiceInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UpdateUserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function updateUser(UpdateUserDto $updateUserDto): void
    {
        $user = $this->userRepository->get($updateUserDto->id);

        $isEmailAlreadyUsed = $this->userRepository->isExistsByEmail($updateUserDto->email);
        if ($isEmailAlreadyUsed && $user->getEmail()->isEqual($updateUserDto->email)) {
            throw new \DomainException(sprintf('Email "%s" is already taken.', $updateUserDto->email));
        }

        $user->changeEmail($updateUserDto->email);
        $user->changeName($updateUserDto->userName);

        $this->userRepository->save($user);
    }
}
