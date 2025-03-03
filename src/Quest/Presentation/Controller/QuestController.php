<?php

declare(strict_types=1);

namespace App\Quest\Presentation\Controller;

use App\Quest\Application\Request\GetListQuestsRequest;
use App\Quest\Application\UseCase\QuestUseCaseInteractor;
use App\Quest\Presentation\Resource\QuestByIdResource;
use App\Quest\Presentation\Resource\QuestsListResource;
use App\Shared\Application\Attribute\RequestQuery;
use App\Shared\Application\Response\ResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class QuestController extends AbstractController
{
    public function __construct(private readonly QuestUseCaseInteractor $useCaseInteractor)
    {
    }

    #[Route('/quests/{id}', methods: 'GET')]
    public function getQuest(string $id): Response
    {
        return ResponseFactory::createSuccessResponse(
            new QuestByIdResource($this->useCaseInteractor->getQuest($id))
        );
    }

    #[Route('/quests', methods: 'GET')]
    public function getQuests(#[RequestQuery] GetListQuestsRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new QuestsListResource($this->useCaseInteractor->getListQuests($request))
        );
    }

    #[Route('/user/me/completed', methods: 'GET')]
    public function getUserQuests(#[RequestQuery] GetListQuestsRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new QuestsListResource($this->useCaseInteractor->getCompletedQuests($request))
        );
    }
}
