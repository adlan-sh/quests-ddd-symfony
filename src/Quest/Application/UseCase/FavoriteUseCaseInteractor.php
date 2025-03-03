<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase;

use App\Quest\Application\Request\GetListQuestsRequest;
use App\Quest\Application\UseCase\AddToFavorite\AddToFavoriteCommand;
use App\Quest\Application\UseCase\GetFavorites\GetFavoritesCommand;
use App\Quest\Application\UseCase\RemoveFromFavorite\RemoveFromFavoriteCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class FavoriteUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function addToFavorite(string $questId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new AddToFavoriteCommand($questId)
        );
    }

    public function removeFromFavorite(string $questId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new RemoveFromFavoriteCommand($questId)
        );
    }

    public function getFavorites(GetListQuestsRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new GetFavoritesCommand(
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
