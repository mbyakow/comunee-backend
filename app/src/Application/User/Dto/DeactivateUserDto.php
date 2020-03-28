<?php

declare(strict_types=1);

namespace App\Application\User\Dto;

use Swagger\Annotations as SWG;

class DeactivateUserDto
{
    /**
     * @var string
     *
     * @SWG\Property(
     *     example="665ebda7-101b-4252-b025-d76875766c05",
     * )
     */
    public string $id;
}
