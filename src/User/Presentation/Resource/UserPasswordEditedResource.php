<?php

namespace App\User\Presentation\Resource;

use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class UserPasswordEditedResource implements ResourceInterface
{
    public function __construct(private CommandResultInterface $commandResult)
    {
    }

    public function toArray(): array
    {
        return [
            'message' => "User's password with ID {$this->commandResult->getResult()} was successfully edited",
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
