<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Controller;

use App\Quest\Application\Request\GetListQuestsRequest;
use App\Quest\Application\UseCase\FavoriteUseCaseInteractor;
use App\Quest\Presentation\Resource\FavoriteResource;
use App\Quest\Presentation\Resource\QuestsListResource;
use App\Shared\Application\Attribute\RequestQuery;
use App\Shared\Application\Response\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class FavoriteController extends AbstractController
{
    public function __construct(private readonly FavoriteUseCaseInteractor $useCaseInteractor)
    {
    }

    #[Route('/quests/{questId}/favorite', methods: 'POST')]
    public function addToFavorite(string $questId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new FavoriteResource($this->useCaseInteractor->addToFavorite($questId))
        );
    }

    #[Route('/quests/{questId}/favorite', methods: 'DELETE')]
    public function removeFromFavorite(string $questId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new FavoriteResource($this->useCaseInteractor->removeFromFavorite($questId))
        );
    }

    #[Route('/user/me/favorite', methods: 'GET')]
    public function getFavorites(#[RequestQuery] GetListQuestsRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new QuestsListResource($this->useCaseInteractor->getFavorites($request))
        );
    }
}
