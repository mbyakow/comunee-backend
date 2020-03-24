<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

use App\Domain\Entity\ValueObject\Email;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Entity\ValueObject\UserName;
use Swagger\Annotations as SWG;

class UserDto
{
    /**
     * @var Id
     *
     * @SWG\Property(
     *     type="string",
     *     example="43c2d5fa-04e4-4bb5-ba33-23304b047dd0"
     * )
     */
    public Id $id;

    /**
     * @var UserName
     *
     * @SWG\Property(
     *     type="string",
     *     example="John Doe"
     * )
     */
    public UserName $userName;

    /**
     * @var Email
     *
     * @SWG\Property(
     *     type="string",
     *     example="john@doe.com"
     * )
     */
    public Email $email;
}
