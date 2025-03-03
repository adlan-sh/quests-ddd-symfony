<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Resource;

use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class QuestByIdResource implements ResourceInterface
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
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['description'],
                'tags' => $result['tags'],
                'code' => $result['code'],
                'seatsCount' => $result['seatsCount'],
                'theme' => $result['theme'],
                'genre' => $result['genre'],
                'dateEvent' => $result['dateEvent'],
                'dateFinalAppointment' => $result['dateFinalAppointment'],
                'gallery' => $result['gallery'],
            ],
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
