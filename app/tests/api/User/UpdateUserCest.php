<?php

declare(strict_types=1);

namespace App\Tests\api\User;

use ApiTester;
use Codeception\Util\HttpCode;

class UpdateUserCest
{
    public function requestWithValidParamsShouldReturn200ResponseCode(ApiTester $I): void
    {
        $I->sendAjaxPostRequest('/api/v1/user_update', [
            'id' => '607246cc-51c5-4787-99cf-afaf76b76599',
            'email' => 'john@doe.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function requestWithInvalidParamsShouldReturn400ResponseCode(ApiTester $I): void
    {
        $I->sendAjaxPostRequest('/api/v1/user_update', []);

        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
    }
}
