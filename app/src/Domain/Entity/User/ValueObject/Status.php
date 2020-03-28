<?php

declare(strict_types=1);

namespace App\Domain\Entity\User\ValueObject;

class Status
{
    public const INACTIVE = 0;
    public const ACTIVE = 1;

    /** @var int */
    private int $status;

    /**
     * Status constructor.
     * @param int $status
     */
    public function __construct(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
