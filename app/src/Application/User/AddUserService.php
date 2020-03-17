<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\Exception\ValidationException;
use App\Application\User\Dto\AddUserDto;
use App\Domain\Entity\User\Factory\UserFactoryInterface;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\UserName;
use App\Domain\Repository\UserRepositoryInterface;

class AddUserService implements AddUserServiceInterface
{
    /** @var UserRepositoryInterface */
    private UserRepositoryInterface $userRepository;

    /** @var UserFactoryInterface */
    private UserFactoryInterface $userFactory;

    /**
     * AddUserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserFactoryInterface $userFactory
     */
    public function __construct(UserRepositoryInterface $userRepository, UserFactoryInterface $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * @inheritDoc
     */
    public function addUser(AddUserDto $addUserDto): void
    {
        $email = new Email($addUserDto->email);

        if ($this->userRepository->isExistsByEmail($email)) {
            throw new ValidationException(sprintf('User with email "%s" already registered.', $email));
        }

        $userName = new UserName($addUserDto->firstName, $addUserDto->lastName);
        $user = $this->userFactory->createUser($email, $userName);

        $this->userRepository->save($user);
    }
}
