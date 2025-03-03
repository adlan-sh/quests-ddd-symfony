<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\RemoveFromFavorite;

use App\Quest\Domain\Service\FavoriteService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Adapter\UserIdAdapter;
use Symfony\Component\HttpFoundation\Response;

readonly class RemoveFromFavoriteCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private FavoriteService $favoriteService,
        private UserIdAdapter $userIdAdapter
    ) {
    }

    public function __invoke(RemoveFromFavoriteCommand $command): CommandResultInterface
    {
        $userId = $this->userIdAdapter->getUserId();

        $this->favoriteService->removeFromFavorite($command->questId, $userId);

        return new RemoveFromFavoriteCommandResult(
            Response::HTTP_OK
        );
    }
}
