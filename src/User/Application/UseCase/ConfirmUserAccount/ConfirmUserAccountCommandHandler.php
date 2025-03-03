<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\ConfirmUserAccount;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Security\UserFetcher;
use App\User\Domain\Service\RegisterUserService;
use Symfony\Component\HttpFoundation\Response;

readonly class ConfirmUserAccountCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private RegisterUserService $registerUserService,
        private UserFetcher $userFetcher
    ) {
    }

    public function __invoke(ConfirmUserAccountCommand $command): CommandResultInterface
    {
        $authUser = $this->userFetcher->getAuthUser();
        $userId = $this->registerUserService->getUserIdByEmail($authUser->getUserIdentifier());
        $this->registerUserService->confirmUser($userId, $command->code);

        return new ConfirmUserAccountCommandResult(Response::HTTP_OK);
    }
}
