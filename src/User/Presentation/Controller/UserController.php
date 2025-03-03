<?php

declare(strict_types=1);

namespace App\User\Presentation\Controller;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Response\ResponseFactory;
use App\User\Application\Request\EditPasswordRequest;
use App\User\Application\Request\EditProfileRequest;
use App\User\Application\UseCase\UserInfoUseCaseInteractor;
use App\User\Presentation\Resource\UserInfoResource;
use App\User\Presentation\Resource\UserPasswordEditedResource;
use App\User\Presentation\Resource\UserWasDeletedResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserInfoUseCaseInteractor $userInfoInteractor,
    ) {
    }

    #[Route('/user/me', methods: 'GET')]
    public function aboutMe(): Response
    {
        return ResponseFactory::createSuccessResponse(
            new UserInfoResource(
                $this->userInfoInteractor->aboutMe()
            )
        );
    }

    #[Route('/user/me', methods: 'POST')]
    public function editProfile(#[RequestBody] EditProfileRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new UserInfoResource(
                $this->userInfoInteractor->editProfile($request)
            )
        );
    }

    #[Route('/user/me', methods: 'DELETE')]
    public function deleteProfile(): Response
    {
        return ResponseFactory::createSuccessResponse(
            new UserWasDeletedResource(
                $this->userInfoInteractor->deleteProfile()
            )
        );
    }

    #[Route('/user/me/password', methods: 'POST')]
    public function editPassword(#[RequestBody] EditPasswordRequest $request): Response
    {
        return ResponseFactory::createSuccessResponse(
            new UserPasswordEditedResource(
                $this->userInfoInteractor->editPassword($request)
            )
        );
    }
}
