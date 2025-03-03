<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase;

use App\Quest\Application\UseCase\SubscribeToQuest\SubscribeToQuestCommand;
use App\Quest\Application\UseCase\UnsubscribeToQuest\UnsubscribeToQuestCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class SubscribeUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function subscribe(string $questId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new SubscribeToQuestCommand($questId)
        );
    }

    public function unsubscribe(string $questId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new UnsubscribeToQuestCommand($questId)
        );
    }
}
