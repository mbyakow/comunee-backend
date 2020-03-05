<?php

declare(strict_types=1);

namespace App\Domain\Entity\User;

use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\UserName;

class User
{
    /** @var int */
    private int $id;

    /** @var Email */
    private Email $email;

    /** @var UserName */
    private UserName $name;

    /**
     * User constructor.
     * @param int $id
     * @param Email $email
     * @param UserName $name
     */
    public function __construct(int $id, Email $email, UserName $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
    }
}
