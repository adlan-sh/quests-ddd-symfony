<?php

namespace App\User\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Request\EditPasswordRequest;
use App\User\Application\Request\EditProfileRequest;
use App\User\Application\UseCase\AboutMe\AboutMeCommand;
use App\User\Application\UseCase\DeleteProfile\DeleteProfileCommand;
use App\User\Application\UseCase\EditPassword\EditPasswordCommand;
use App\User\Application\UseCase\EditProfile\EditProfileCommand;

readonly class UserInfoUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function aboutMe(): CommandResultInterface
    {
        return $this->commandBus->execute(
            new AboutMeCommand()
        );
    }

    public function editProfile(EditProfileRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new EditProfileCommand(
                $request->getFirstName(),
                $request->getLastName(),
                $request->getMiddleName(),
                $request->getEmail(),
                $request->getPhone(),
                $request->getPhoto()
            )
        );
    }

    public function deleteProfile(): CommandResultInterface
    {
        return $this->commandBus->execute(
            new DeleteProfileCommand()
        );
    }

    public function editPassword(EditPasswordRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new EditPasswordCommand(
                $request->getNewPassword(),
                $request->getConfirmPassword()
            )
        );
    }
}
