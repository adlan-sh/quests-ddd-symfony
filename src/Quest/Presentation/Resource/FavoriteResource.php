<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Resource;

use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class FavoriteResource implements ResourceInterface
{
    public function __construct(
        private CommandResultInterface $commandResult
    ) {
    }

    public function toArray(): array
    {
        $result = $this->commandResult->getResult();

        return [
            'message' => $result['message'],
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
