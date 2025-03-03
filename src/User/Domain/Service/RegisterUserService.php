<?php

declare(strict_types=1);

namespace App\User\Domain\Service;

use App\Shared\Domain\Service\MailServiceInterface;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Exception\UserCodeIsInvalidException;
use App\User\Domain\Repository\CodeRepositoryInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

readonly class RegisterUserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CodeRepositoryInterface $codeRepository,
        private MailServiceInterface $mailService
    ) {
    }

    public function createUser(array $user): string
    {
        if ($this->userRepository->existsByEmailOrPhone($user['email'], $user['phone'])) {
            throw new UserAlreadyExistsException();
        }

        $userId = $this->userRepository->create($user);
        $code = random_int(100000, 999999);

        $this->mailService->sendRegisterEmail($user['email'], $code);
        $this->codeRepository->save($userId, $code);

        return $userId;
    }

    public function getUserIdByEmail(string $email): string
    {
        return $this->userRepository->findByParam('email', $email)?->getId();
    }

    public function confirmUser(string $userId, string $code): void
    {
        if (!$this->codeRepository->isValid($userId, $code)) {
            throw new UserCodeIsInvalidException();
        }

        $this->userRepository->confirm($userId);
    }
}
