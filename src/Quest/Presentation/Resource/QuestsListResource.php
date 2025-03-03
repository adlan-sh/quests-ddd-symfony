<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Resource;

use App\Quest\Application\Model\QuestListItemDTO;
use App\Shared\Application\Resource\ResourceInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class QuestsListResource implements ResourceInterface
{
    public function __construct(private CommandResultInterface $commandResult)
    {
    }

    public function toArray(): array
    {
        $result = $this->commandResult->getResult();

        return [
            'data' => [
                'pagination' => new PaginationResource($result['pagination']),
                'list' => array_map(static fn (QuestListItemDTO $data) => new QuestListItemResource($data), $result['list']),
            ],
        ];
    }

    public function getCode(): int
    {
        return $this->commandResult->getCode();
    }
}
