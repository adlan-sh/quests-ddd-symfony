<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\EditProfile;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\Mapper\FileMapper;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Mapper\UserMapper;
use App\User\Application\Security\UserFetcher;
use App\User\Domain\Service\UserInfoService;
use Symfony\Component\HttpFoundation\Response;

readonly class EditProfileCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserInfoService $userInfoService,
        private UserFetcher $userFetcher,
    ) {
    }

    public function __invoke(EditProfileCommand $command): CommandResultInterface
    {
        $authUser = $this->userFetcher->getAuthUser();
        $user = $this->userInfoService->getUserInfo($authUser->getUserIdentifier());
        $oldEmail = $user->getEmail();

        $photo = null;
        $fileInfo = null;
        if (null !== $command->photo) {
            $photo = FileMapper::toPhoto($command->photo);
            $fileInfo = [
                'name' => $command->photo['name'],
                'url' => $command->photo['url'],
            ];
        }

        $newUser = UserMapper::toNewUser($user, $command, $photo);

        return new EditProfileCommandResult(
            UserMapper::toAboutMeDTO($this->userInfoService->editUserInfo($newUser, $oldEmail, $fileInfo)),
            Response::HTTP_OK
        );
    }
}
