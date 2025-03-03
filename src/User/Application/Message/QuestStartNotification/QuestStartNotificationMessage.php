<?php

declare(strict_types=1);

namespace App\User\Application\Message\QuestStartNotification;

readonly class QuestStartNotificationMessage
{
    public function __construct(public string $email, public string $questName)
    {
    }
}
