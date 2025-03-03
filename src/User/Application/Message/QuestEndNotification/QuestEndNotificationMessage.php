<?php

declare(strict_types=1);

namespace App\User\Application\Message\QuestEndNotification;

readonly class QuestEndNotificationMessage
{
    public function __construct(public string $email, public string $questName)
    {
    }
}
