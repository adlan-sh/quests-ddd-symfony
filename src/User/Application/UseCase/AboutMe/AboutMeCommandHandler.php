<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\AboutMe;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Mapper\UserMapper;
use App\User\Application\Security\UserFetcher;
use App\User\Domain\Service\UserInfoService;
use Symfony\Component\HttpFoundation\Response;

readonly class AboutMeCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserInfoService $userInfoService,
        private UserFetcher $userFetcher
    ) {
    }

    public function __invoke(AboutMeCommand $command): CommandResultInterface
    {
        return new AboutMeCommandResult(
            UserMapper::toAboutMeDTO(
                $this->userInfoService->getUserInfo(
                    $this->userFetcher->getAuthUser()->getUserIdentifier()
                )
            ),
            Response::HTTP_OK
        );
    }
}
