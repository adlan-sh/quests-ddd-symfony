<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

readonly class ExceptionMapping
{
    public function __construct(private int $code)
    {
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
