<?php

declare(strict_types=1);

namespace App\Shared\Application\UseCase;

readonly class ExceptionCommandResult implements CommandResultInterface
{
    public function __construct(
        public mixed $message,
        public int $code
    ) {
    }

    public function getResult(): string
    {
        return $this->message;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
