<?php

declare(strict_types=1);

namespace App\DataFixtures;

class UserFixture extends AbstractFixture
{
    /** @var string  */
    public string $tableName = 'public.user';

    /** @var string  */
    public string $dataFile = 'tests/fixtures/users.php';
}
