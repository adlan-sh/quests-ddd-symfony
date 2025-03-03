<?php

declare(strict_types=1);

namespace App\User\Application\Message\QuestStartNotification;

use App\Shared\Domain\Service\MailServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class QuestStartNotificationMessageHandler
{
    public function __construct(private MailServiceInterface $mailService)
    {
    }

    public function __invoke(QuestStartNotificationMessage $message): void
    {
        $this->mailService->sendEmailQuestStart($message->email, $message->questName);
    }
}
