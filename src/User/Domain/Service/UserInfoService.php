<?php

declare(strict_types=1);

namespace App\User\Domain\Service;

use App\Shared\Domain\Service\MailServiceInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Repository\CodeRepositoryInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

readonly class UserInfoService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CodeRepositoryInterface $codeRepository,
        private MailServiceInterface $mailService
    ) {
    }

    public function getUserInfo(string $email): User
    {
        $user = $this->userRepository->findByParam('email', $email);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function editUserInfo(User $user, string $oldEmail, ?array $file): User
    {
        if (null === $this->userRepository->findByParam('email', $oldEmail)) {
            throw new UserNotFoundException();
        }

        if (!$this->userRepository->emailAndPhoneNotBusy(
            $user->getId(),
            $user->getEmail(),
            $user->getPhone())
        ) {
            throw new UserAlreadyExistsException();
        }

        if ($user->getEmail() !== $oldEmail) {
            $user->setIsConfirmed(false);

            $code = random_int(100000, 999999);

            $this->mailService->sendEmailEdited($user->getEmail(), $code);
            $this->codeRepository->save($user->getId(), $code);
        }

        return $this->userRepository->edit($user, $file);
    }

    public function deleteUserInfo(string $email): string
    {
        $user = $this->userRepository->findByParam('email', $email);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $this->userRepository->delete($user->getId());
    }

    public function editPassword(string $email, string $newPassword): string
    {
        $user = $this->userRepository->findByParam('email', $email);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $this->userRepository->editPassword($user, $newPassword);
    }
}
