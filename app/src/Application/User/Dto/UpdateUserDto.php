<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

use Swagger\Annotations as SWG;

class UpdateUserDto
{
    /**
     * @var string
     *
     * @SWG\Property(
     *     example="665ebda7-101b-4252-b025-d76875766c05",
     * )
     */
    public string $id;

    /**
     * @var string
     *
     * @SWG\Property(
     *     example="John",
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
