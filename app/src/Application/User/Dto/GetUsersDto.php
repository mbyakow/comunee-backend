<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

use Swagger\Annotations as SWG;

class GetUsersDto
{
    /**
     * @var string
     *
     * @SWG\Property(
     *     example="John",
     * )
     */
    public string $name;
}
