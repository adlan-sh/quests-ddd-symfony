<?php

declare(strict_types=1);

namespace App\Shared\Application\UseCase;

interface CommandResultInterface
{
    public function getResult(): mixed;

    public function getCode(): int;
}
