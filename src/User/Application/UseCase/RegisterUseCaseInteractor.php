<?php

declare(strict_types=1);

namespace App\User\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Request\RegisterUserRequest;
use App\User\Application\Request\UserCodeRequest;
use App\User\Application\UseCase\ConfirmUserAccount\ConfirmUserAccountCommand;
use App\User\Application\UseCase\RegisterUser\RegisterUserCommand;

readonly class RegisterUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function registerUser(RegisterUserRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new RegisterUserCommand(
                $request->getFirstName(),
                $request->getLastName(),
                $request->getMiddleName(),
                $request->getEmail(),
                $request->getPhone(),
                $request->getPassword()
            )
        );
    }

    public function confirmRegister(UserCodeRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new ConfirmUserAccountCommand(
                (string) $request->getCode()
            )
        );
    }
}
