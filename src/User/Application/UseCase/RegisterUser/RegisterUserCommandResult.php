<?php

namespace App\User\Application\UseCase\RegisterUser;

use App\Shared\Application\UseCase\CommandResultInterface;

readonly class RegisterUserCommandResult implements CommandResultInterface
{
    public function __construct(
        public string $userId,
        public int $code
    ) {
    }

    public function getResult(): string
    {
        return $this->userId;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
