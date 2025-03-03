<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\EditPassword;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Security\UserFetcher;
use App\User\Domain\Service\UserInfoService;
use Symfony\Component\HttpFoundation\Response;

readonly class EditPasswordCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserInfoService $userInfoService,
        private UserFetcher $userFetcher
    ) {
    }

    public function __invoke(EditPasswordCommand $command): CommandResultInterface
    {
        return new EditPasswordCommandResult(
            $this->userInfoService->editPassword(
                $this->userFetcher->getAuthUser()->getUserIdentifier(),
                $command->newPassword
            ),
            Response::HTTP_OK
        );
    }
}
