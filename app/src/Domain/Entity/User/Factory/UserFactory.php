<?php

declare(strict_types=1);

namespace App\Domain\Entity\User\Factory;

use App\Domain\Entity\User\User;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\UserName;
use App\Domain\Repository\UserRepositoryInterface;

class UserFactory implements UserFactoryInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /**
     * UserFactory constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Email $email
     * @param UserName $userName
     * @return User
     */
    public function createUser(Email $email, UserName $userName): User
    {
        $id = $this->userRepository->getNextIdentity();

        return new User($id, $email, $userName);
    }
}
