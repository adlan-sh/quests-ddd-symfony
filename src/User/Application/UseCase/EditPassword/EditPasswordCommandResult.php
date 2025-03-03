<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\EditPassword;

use App\Shared\Application\UseCase\CommandResultInterface;

class EditPasswordCommandResult implements CommandResultInterface
{
    public function __construct(public string $uuid, public int $code)
    {
    }

    public function getResult(): string
    {
        return $this->uuid;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
