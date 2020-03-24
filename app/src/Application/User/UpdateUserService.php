<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\User\Dto\UpdateUserDto;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Entity\ValueObject\UserName;
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
        $user = $this->userRepository->get(new Id($updateUserDto->id));

        $email = new Email($updateUserDto->email);
        $isEmailAlreadyUsed = $this->userRepository->isExistsByEmail($email);
        if ($isEmailAlreadyUsed && $user->getEmail()->isEqual($email)) {
            throw new \DomainException(sprintf('Email "%s" is already taken.', $email));
        }

        $user->changeEmail($email);
        $user->changeName(new UserName($updateUserDto->firstName, $updateUserDto->lastName));

        $this->userRepository->save($user);
    }
}
