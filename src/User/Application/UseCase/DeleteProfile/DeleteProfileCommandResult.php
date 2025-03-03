<?php

namespace App\User\Application\UseCase\DeleteProfile;

use App\Shared\Application\UseCase\CommandResultInterface;

class DeleteProfileCommandResult implements CommandResultInterface
{
    public function __construct(public string $uuid, public int $code)
    {
    }

    public function getResult(): string
    {
        return "User with ID {$this->uuid} was deleted";
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
