<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

use Swagger\Annotations as SWG;

class AddUserDto
{
    /**
     * @var string
     *
     * @SWG\Property(
     *     example="John"
     * )
     */
    public string $firstName;

    /**
     * @var string
     *
     * @SWG\Property(
     *     example="Doe",
     * )
     */
    public string $lastName;

    /**
     * @var string
     *
     * @SWG\Property(
     *     example="john@doe.com",
     * )
     */
    public string $email;
}
