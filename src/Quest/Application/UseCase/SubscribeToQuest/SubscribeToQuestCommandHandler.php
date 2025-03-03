<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\SubscribeToQuest;

use App\Quest\Domain\Service\SubscribeService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Adapter\UserIdAdapter;
use Symfony\Component\HttpFoundation\Response;

readonly class SubscribeToQuestCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SubscribeService $subscribeService,
        private UserIdAdapter $userIdAdapter
    ) {
    }

    public function __invoke(SubscribeToQuestCommand $command): CommandResultInterface
    {
        $userId = $this->userIdAdapter->getUserId();

        return new SubscribeToQuestCommandResult(
            $this->subscribeService->subscribe($command->questId, $userId),
            Response::HTTP_OK
        );
    }
}
