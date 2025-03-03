<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\ConfirmUserAccount;

use App\Shared\Application\UseCase\CommandResultInterface;

readonly class ConfirmUserAccountCommandResult implements CommandResultInterface
{
    public function __construct(private int $code)
    {
    }

    public function getResult(): array
    {
        return [
            'message' => 'User account was successfully confirmed.',
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
