<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\User;

use App\Domain\Entity\User\User;
use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\UserName;
use Codeception\Test\Unit;

class UserTest extends Unit
{
    /**
     * @param $id
     * @param $email
     * @param $userName
     * @dataProvider correctValuesDataProvider
     */
    public function testCreateWithCorrectParamsShouldNotRaiseException($id, $email, $userName): void
    {
        new User($id, $email, $userName);
    }

    public function correctValuesDataProvider(): array
    {
        return [
            [1, new Email('some@user.com'), new UserName('Some', 'User')],
        ];
    }
}
