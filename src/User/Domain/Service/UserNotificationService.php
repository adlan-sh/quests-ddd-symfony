<?php

declare(strict_types=1);

namespace App\User\Domain\Service;

use App\User\Domain\Repository\UserRepositoryInterface;

readonly class UserNotificationService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function getEmailsAndQuestsForQuestStartNotification(): array
    {
        $notifyUsers = $this->userRepository->getEmailsAndQuestsSubscribedUsers();

        return array_filter($notifyUsers,
            static function (array $data) {
                $dateInterval = (new \DateTimeImmutable())->diff($data['dateEvent']);
                if (2 === $dateInterval->d && $dateInterval->h > 1) {
                    return [
                        'email' => $data['email'],
                        'name' => $data['name'],
                    ];
                }
            }
        );
    }

    public function getEmailsAndQuestsForQuestEndNotification(): array
    {
        $notifyUsers = $this->userRepository->getEmailsAndEndedQuestsSubscribedUsers();

        return array_filter($notifyUsers,
            static function (array $data) {
                $dateInterval = (new \DateTimeImmutable())->diff($data['dateEvent']);
                if (1 === $dateInterval->d) {
                    return [
                        'email' => $data['email'],
                        'name' => $data['name'],
                    ];
                }
            }
        );
    }
}
