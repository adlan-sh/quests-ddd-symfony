<?php

declare(strict_types=1);

namespace App\User\Presentation\Controller;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Response\ResponseFactory;
use App\User\Application\Request\RegisterUserRequest;
use App\User\Application\Request\UserCodeRequest;
use App\User\Application\UseCase\RegisterUseCaseInteractor;
use App\User\Presentation\Resource\UserAccountWasConfirmedResource;
use App\User\Presentation\Resource\UserWasRegisteredResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly RegisterUseCaseInteractor $interactor
    ) {
    }

    #[Route('/user/signUp', methods: 'POST')]
    public function signUp(#[RequestBody] RegisterUserRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new UserWasRegisteredResource(
                $this->interactor->registerUser($request)
            )
        );
    }

    #[Route('/user/confirm', methods: 'POST')]
    public function confirm(#[RequestBody] UserCodeRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new UserAccountWasConfirmedResource(
                $this->interactor->confirmRegister($request)
            )
        );
    }
}
