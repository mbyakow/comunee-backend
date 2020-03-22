<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\User;

use App\Domain\Entity\User\User;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Entity\ValueObject\UserName;
use Codeception\Test\Unit;

class UserTest extends Unit
{
    public function testCreateShouldNotRaiseException(): void
    {
        new User(new Id('abc'), new Email('some@user.com'), new UserName('Some', 'User'));
    }

    public function testChangeNameShouldAssignNewName(): void
    {
        $initialUserName = new UserName('Some', 'User');
        $newUserName = new UserName('John', 'Doe');
        $user = new User(new Id('abc'), new Email('some@user.com'), $initialUserName);

        $user->changeName($newUserName);

        $this->assertEquals($user->getName(), $newUserName);
    }

    public function testChangeEmailShouldAssignNewEmail(): void
    {
        $initialEmail = new Email('some@user.com');
        $newEmail = new Email('some@user.com');
        $user = new User(new Id('abc'), $initialEmail, new UserName('Some', 'User'));

        $user->changeEmail($newEmail);

        $this->assertEquals($user->getEmail(), $newEmail);
    }
}
