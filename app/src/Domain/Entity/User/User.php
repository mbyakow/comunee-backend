<?php

declare(strict_types=1);

namespace App\Domain\Entity\User;

use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\UserName;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

class User
{
    /** @var int */
    private int $id;

    /** @var Email */
    private Email $email;

    /** @var UserName */
    private UserName $name;

    /** @var DateTimeInterface */
    private DateTimeInterface $createdAt;

    /** @var DateTimeInterface */
    private DateTimeInterface $updatedAt;

    /**
     * User constructor.
     * @param int $id
     * @param Email $email
     * @param UserName $name
     * @throws Exception
     */
    public function __construct(int $id, Email $email, UserName $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return UserName
     */
    public function getName(): UserName
    {
        return $this->name;
    }

    /**
     * @param UserName $userName
     */
    public function changeName(UserName $userName): void
    {
        $this->name = $userName;
    }

    /**
     * @param Email $email
     */
    public function changeEmail(Email $email): void
    {
        $this->email = $email;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}
