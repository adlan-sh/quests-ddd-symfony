<?php

declare(strict_types=1);

namespace App\User\Application\Adapter;

use App\User\Application\Security\UserFetcher;
use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Repository\UserRepositoryInterface;

readonly class UserIdAdapter
{
    public function __construct(
        private UserFetcher $userFetcher,
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function getUserId(): string
    {
        $user = $this->userFetcher->getAuthUser();

        $userOrm = $this->userRepository->findByParam('email', $user->getUserIdentifier());

        if (null === $userOrm) {
            throw new UserNotFoundException();
        }

        return $userOrm->getId();
    }
}
