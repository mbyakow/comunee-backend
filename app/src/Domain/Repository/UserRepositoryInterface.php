<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User\User;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;

interface UserRepositoryInterface
{
    /**
     * @return Id
     */
    public function getNextIdentity(): Id;

    /**
     * @param Id $id
     * @return User
     */
    public function get(Id $id): User;

    /**
     * @param Email $email
     * @return bool
     */
    public function isExistsByEmail(Email $email): bool;

    /**
     * @return User[]
     */
    public function getAll(): array;

    /**
     * @param User $user
     */
    public function save(User $user): void;
}
