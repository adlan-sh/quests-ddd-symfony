<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetCompletedQuests;

use App\Quest\Application\Mapper\QuestMapper;
use App\Quest\Domain\Service\QuestService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Adapter\UserIdAdapter;
use Symfony\Component\HttpFoundation\Response;

readonly class GetCompletedQuestsCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserIdAdapter $userIdAdapter,
        private QuestService $questService
    ) {
    }

    public function __invoke(GetCompletedQuestsCommand $command): CommandResultInterface
    {
        $userId = $this->userIdAdapter->getUserId();

        $quests = $this->questService->getCompleted(
            $userId,
            $command->page,
            $command->limit,
            $command->sort,
            $command->filter,
            $command->search
        );

        return new GetCompletedQuestsCommandResult(
            QuestMapper::toPaginationDTO($quests['pagination']),
            QuestMapper::toQuestListDTO($quests['list']),
            Response::HTTP_OK
        );
    }
}
