<?php

namespace App\Review\Presentation\Resource;

use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class ReviewWasDeletedResource implements ResourceInterface
{
    public function __construct(private CommandResultInterface $commandResult)
    {
    }

    public function toArray(): array
    {
        return [
            'message' => $this->commandResult->getResult(),
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
