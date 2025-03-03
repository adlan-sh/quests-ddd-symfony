<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetListQuests;

use App\Quest\Application\Mapper\QuestMapper;
use App\Quest\Domain\Service\QuestService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class GetListQuestsCommandHandler implements CommandHandlerInterface
{
    public function __construct(private QuestService $questService)
    {
    }

    public function __invoke(GetListQuestsCommand $command): CommandResultInterface
    {
        $questsList = $this->questService->getQuests(
            $command->page,
            $command->limit,
            $command->sort,
            $command->filter,
            $command->search
        );

        return new GetListQuestsCommandResult(
            QuestMapper::toPaginationDTO($questsList['pagination']),
            QuestMapper::toQuestListDTO($questsList['list']),
            Response::HTTP_OK
        );
    }
}
