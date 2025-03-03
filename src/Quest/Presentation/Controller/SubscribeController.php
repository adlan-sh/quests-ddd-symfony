<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Controller;

use App\Quest\Application\UseCase\SubscribeUseCaseInteractor;
use App\Quest\Presentation\Resource\SubscribeResource;
use App\Shared\Application\Response\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class SubscribeController extends AbstractController
{
    public function __construct(private readonly SubscribeUseCaseInteractor $useCaseInteractor)
    {
    }

    #[Route('/quests/{questId}/subscribe', methods: 'POST')]
    public function subscribe(string $questId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new SubscribeResource($this->useCaseInteractor->subscribe($questId))
        );
    }

    #[Route('/quests/{questId}/subscribe', methods: 'DELETE')]
    public function unsubscribe(string $questId): Response
    {
        return ResponseFactory::createSuccessResponse(
            new SubscribeResource($this->useCaseInteractor->unsubscribe($questId))
        );
    }
}
