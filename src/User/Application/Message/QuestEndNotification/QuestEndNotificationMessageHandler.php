<?php

declare(strict_types=1);

namespace App\User\Application\Message\QuestEndNotification;

use App\Shared\Domain\Service\MailServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class QuestEndNotificationMessageHandler
{
    public function __construct(private MailServiceInterface $mailService)
    {
    }

    public function __invoke(QuestEndNotificationMessage $message): void
    {
        $this->mailService->sendEmailQuestEnd($message->email, $message->questName);
    }
}
