<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase;

use App\Quest\Application\Request\GetListQuestsRequest;
use App\Quest\Application\UseCase\GetCompletedQuests\GetCompletedQuestsCommand;
use App\Quest\Application\UseCase\GetListQuests\GetListQuestsCommand;
use App\Quest\Application\UseCase\GetQuest\GetQuestCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class QuestUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function getQuest(string $questId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new GetQuestCommand($questId)
        );
    }

    public function getListQuests(GetListQuestsRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new GetListQuestsCommand(
                $request->getPage(),
                $request->getLimit(),
                $request->getSort(),
                array_combine(
                    $request->getFilterKey(),
                    $request->getFilterValue()
                ),
                $request->getSearch()
            )
        );
    }

    public function getCompletedQuests(GetListQuestsRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new GetCompletedQuestsCommand(
                $request->getPage(),
                $request->getLimit(),
                $request->getSort(),
                array_combine(
                    $request->getFilterKey(),
                    $request->getFilterValue()
                ),
                $request->getSearch()
            )
        );
    }
}
