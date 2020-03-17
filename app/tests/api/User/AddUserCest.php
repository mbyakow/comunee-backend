<?php

declare(strict_types=1);

namespace App\Tests\api\User;

use ApiTester;
use Codeception\Util\HttpCode;

class AddUserCest
{
    public function requestWithInvalidParamsShouldReturn400ResponseCode(ApiTester $I): void
    {
        $I->sendAjaxPostRequest('/api/v1/user_add', []);

        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
    }
}
