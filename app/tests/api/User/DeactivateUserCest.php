<?php

declare(strict_types=1);

namespace App\Tests\api\User;

use Codeception\Util\HttpCode;

class DeactivateUserCest
{
    public function requestShouldReturn200ResponseCode(\ApiTester $I): void
    {
        $I->sendAjaxPostRequest('/api/v1/user_deactivate', [
            'id' => '607246cc-51c5-4787-99cf-afaf76b76599',
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
    }
}
