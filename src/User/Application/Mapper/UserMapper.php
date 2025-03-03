<?php

namespace App\User\Application\Mapper;

use App\Shared\Domain\ValueObject\Photo;
use App\User\Application\Model\AboutMeDTO;
use App\User\Application\Model\UserDTO;
use App\User\Application\UseCase\EditProfile\EditProfileCommand;
use App\User\Application\UseCase\RegisterUser\RegisterUserCommand;
use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\FullName;

class UserMapper
{
    public static function fromCommand(RegisterUserCommand $command): UserDTO
    {
        return (new UserDTO())
            ->setFirstName($command->firstName)
            ->setLastName($command->lastName)
            ->setMiddleName($command->middleName)
            ->setEmail($command->email)
            ->setPassword($command->password)
            ->setPhone($command->phone);
    }

    public static function toAboutMeDTO(User $user): AboutMeDTO
    {
        return (new AboutMeDTO())
            ->setFirstName($user->getFullName()->firstName)
            ->setLastName($user->getFullName()->lastName)
            ->setMiddleName($user->getFullName()->middleName)
            ->setEmail($user->getEmail())
            ->setPhone($user->getPhone())
            ->setPhoto($user->getPhoto());
    }

    public static function toNewUser(User $user, EditProfileCommand $command, ?Photo $photo): User
    {
        $user->setFullName(
            new FullName(
                $command->firstName,
                $command->lastName,
                $command->middleName
            )
        )
        ->setEmail($command->email)
        ->setPhone($command->phone)
        ->setPhoto($photo);

        return $user;
    }
}
