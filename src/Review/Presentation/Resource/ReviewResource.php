<?php

declare(strict_types=1);

namespace App\Review\Presentation\Resource;

use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class ReviewResource implements ResourceInterface
{
    public function __construct(
        private CommandResultInterface $commandResult
    ) {
    }

    public function toArray(): array
    {
        $result = $this->commandResult->getResult();

        return [
            'data' => [
                'score' => $result['score'],
                'text' => $result['text'],
            ],
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
