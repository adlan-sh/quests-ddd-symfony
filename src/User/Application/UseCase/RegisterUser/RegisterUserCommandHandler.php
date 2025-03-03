<?php

namespace App\User\Application\UseCase\RegisterUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Mapper\UserMapper;
use App\User\Domain\Service\RegisterUserService;
use Symfony\Component\HttpFoundation\Response;

readonly class RegisterUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private RegisterUserService $registerUserService
    ) {
    }

    public function __invoke(RegisterUserCommand $command): CommandResultInterface
    {
        return new RegisterUserCommandResult(
            $this->registerUserService->createUser(UserMapper::fromCommand($command)->toArray()),
            Response::HTTP_OK
        );
    }
}
