<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\ValueObject;

use App\Domain\Entity\ValueObject\Email;
use Codeception\Test\Unit;

class EmailTest extends Unit
{
    /**
     * @param $value
     * @dataProvider correctValuesDataProvider
     */
    public function testCreateWithCorrectValueShouldNotRaiseException($value): void
    {
        new Email($value);
    }

    /**
     * @param $value
     * @dataProvider incorrectValuesDataProvider
     */
    public function testCreateWithIncorrectValueShouldRaiseException($value): void
    {
        $this->expectException(\DomainException::class);

        new Email($value);
    }

    /**
     * @param $value
     * @dataProvider correctValuesDataProvider
     */
    public function testCreateShouldAssignCorrectValue($value): void
    {
        $email = new Email($value);

        $this->assertEquals($email, $value);
    }

    public function correctValuesDataProvider(): array
    {
        return [
            ['some@email.com'],
            ['correct@email.co.uk'],
            ['hello@from.ru'],
        ];
    }

    public function incorrectValuesDataProvider(): array
    {
        return [
            ['some@email'],
            ['12345'],
            ['!!!!!!!@@@@@.com'],
        ];
    }
}
