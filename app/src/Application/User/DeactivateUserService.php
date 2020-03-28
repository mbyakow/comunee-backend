<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\DeactivateUserDto;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Repository\UserRepositoryInterface;

class DeactivateUserService implements DeactivateUserServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /**
     * DeactivateUserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function deactivateUser(DeactivateUserDto $deactivateUserDto): void
    {
        $user = $this->userRepository->get(new Id($deactivateUserDto->id));

        $user->deactivate();

        $this->userRepository->save($user);
    }
}
