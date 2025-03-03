<?php

namespace App\User\Application\UseCase\DeleteProfile;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Security\UserFetcher;
use App\User\Domain\Service\UserInfoService;
use Symfony\Component\HttpFoundation\Response;

readonly class DeleteProfileCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserInfoService $userInfoService,
        private UserFetcher $userFetcher
    ) {
    }

    public function __invoke(DeleteProfileCommand $command): CommandResultInterface
    {
        return new DeleteProfileCommandResult(
            $this->userInfoService->deleteUserInfo(
                $this->userFetcher->getAuthUser()->getUserIdentifier()
            ),
            Response::HTTP_OK
        );
    }
}
