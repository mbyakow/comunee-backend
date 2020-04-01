<?php

declare(strict_types=1);

namespace App\Tests\api\User;

use Codeception\Util\HttpCode;

class GetUsersCest
{
    public function requestShouldReturn200ResponseCode(\ApiTester $I): void
    {
        $I->sendAjaxPostRequest('/api/v1/users_get-list');

        $I->seeResponseCodeIs(HttpCode::OK);
    }
}
