<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetFavorites;

use App\Quest\Application\Mapper\QuestMapper;
use App\Quest\Domain\Service\FavoriteService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Adapter\UserIdAdapter;
use Symfony\Component\HttpFoundation\Response;

readonly class GetFavoritesCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserIdAdapter $userIdAdapter,
        private FavoriteService $favoriteService
    ) {
    }

    public function __invoke(GetFavoritesCommand $command): CommandResultInterface
    {
        $userId = $this->userIdAdapter->getUserId();

        $favorites = $this->favoriteService->getFavorites(
            $userId,
            $command->page,
            $command->limit,
            $command->sort,
            $command->filter,
            $command->search
        );

        return new GetFavoritesCommandResult(
            QuestMapper::toPaginationDTO($favorites['pagination']),
            QuestMapper::toQuestListDTO($favorites['list']),
            Response::HTTP_OK
        );
    }
}
