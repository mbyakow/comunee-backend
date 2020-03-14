<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\ValueObject;

use App\Domain\Entity\ValueObject\Email;
use Codeception\Test\Unit;
use DomainException;

class EmailTest extends Unit
{
    /**
     * @param $value
     * @dataProvider validValuesDataProvider
     */
    public function testCreateWithValidValueShouldNotRaiseException($value): void
    {
        new Email($value);
    }

    /**
     * @param $value
     * @dataProvider invalidValuesDataProvider
     */
    public function testCreateWithInvalidValueShouldRaiseException($value): void
    {
        $this->expectException(DomainException::class);

        new Email($value);
    }

    /**
     * @param $value
     * @dataProvider validValuesDataProvider
     */
    public function testCreateShouldAssignCorrectEmail($value): void
    {
        $email = new Email($value);

        $this->assertEquals($email, $value);
    }

    public function validValuesDataProvider(): array
    {
        return [
            ['some@email.com'],
            ['correct@email.co.uk'],
            ['hello@from.ru'],
        ];
    }

    public function invalidValuesDataProvider(): array
    {
        return [
            ['some@email'],
            ['12345'],
            ['!!!!!!!@@@@@.com'],
        ];
    }
}
