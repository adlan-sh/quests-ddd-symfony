<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetQuest;

use App\Quest\Application\Mapper\QuestMapper;
use App\Quest\Domain\Service\QuestService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class GetQuestCommandHandler implements CommandHandlerInterface
{
    public function __construct(private QuestService $questService)
    {
    }

    public function __invoke(GetQuestCommand $command): CommandResultInterface
    {
        return new GetQuestCommandResult(
            QuestMapper::toQuestDTO($this->questService->getQuestById($command->id)),
            Response::HTTP_OK
        );
    }
}
