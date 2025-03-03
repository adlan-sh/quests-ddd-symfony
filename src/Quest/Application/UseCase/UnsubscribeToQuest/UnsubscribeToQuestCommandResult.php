<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\UnsubscribeToQuest;

use App\Quest\Domain\Entity\SubscribeStatus;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class UnsubscribeToQuestCommandResult implements CommandResultInterface
{
    private string $message;

    public function __construct(private SubscribeStatus $subscribeStatus, private int $code)
    {
        switch ($subscribeStatus) {
            case SubscribeStatus::Success:
                $this->message = 'You have been successfully unsubscribed from the quest.';
                break;
            case SubscribeStatus::NonSubscribed:
                $this->message = 'You haven\'t subscribed to this quest yet.';
                break;
            default:
                break;
        }
    }

    public function getResult(): array
    {
        return [
            'message' => $this->message,
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
