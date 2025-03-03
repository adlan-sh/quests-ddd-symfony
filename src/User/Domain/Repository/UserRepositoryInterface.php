<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * Возвращает UUID пользователя.
     */
    public function create(array $user): string;

    public function existsByParam(string $name, string $value): bool;

    public function existsByEmailOrPhone(string $email, string $phone): bool;

    public function findByParam(string $name, string $value): ?User;

    public function emailAndPhoneNotBusy(string $id, string $email, string $phone): bool;

    public function edit(User $user, array $file): User;

    public function delete(string $id): string;

    public function editPassword(User $user, string $newPassword): string;

    public function confirm(string $userId): void;

    public function getEmailsAndQuestsSubscribedUsers(): array;

    public function getEmailsAndEndedQuestsSubscribedUsers(): array;
}
