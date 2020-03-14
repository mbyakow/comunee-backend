<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\ValueObject;

use App\Domain\Entity\ValueObject\UserName;
use Codeception\Test\Unit;

class UserNameTest extends Unit
{
    /**
     * @param $firstName
     * @param $lastName
     * @dataProvider validValuesDataProvider
     */
    public function testCreateWithValidParamsShouldNotRaiseException($firstName, $lastName): void
    {
        new UserName($firstName, $lastName);
    }

    public function validValuesDataProvider(): array
    {
        return [
            ['John', 'Doe'],
            ['Ivan', 'Ivanov'],
            ['Will', 'Smith'],
        ];
    }
}
