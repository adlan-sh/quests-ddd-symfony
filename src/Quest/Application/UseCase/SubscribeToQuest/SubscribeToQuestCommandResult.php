<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\SubscribeToQuest;

use App\Quest\Domain\Entity\SubscribeStatus;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class SubscribeToQuestCommandResult implements CommandResultInterface
{
    private string $message;

    public function __construct(private SubscribeStatus $subscribeStatus, private int $code)
    {
        switch ($subscribeStatus) {
            case SubscribeStatus::Success:
                $this->message = 'You have been successfully signed up for the quest.';
                break;
            case SubscribeStatus::AlreadySubscribed:
                $this->message = 'You have already subscribed to this quest.';
                break;
            case SubscribeStatus::Full:
                $this->message = 'There are currently no places for this quest.';
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
