<?php

declare(strict_types=1);

namespace App\Quest\Domain\Service;

use App\Quest\Domain\Entity\SubscribeStatus;
use App\Quest\Domain\Repository\SubscribeRepositoryInterface;

readonly class SubscribeService
{
    public function __construct(private SubscribeRepositoryInterface $subscribeRepository)
    {
    }

    public function subscribe(string $questId, string $userId): SubscribeStatus
    {
        if (!$this->subscribeRepository->hasSeats($questId)) {
            return SubscribeStatus::Full;
        }

        if (!$this->subscribeRepository->subscribe($questId, $userId)) {
            return SubscribeStatus::AlreadySubscribed;
        }

        return SubscribeStatus::Success;
    }

    public function unsubscribe(string $questId, string $userId): SubscribeStatus
    {
        if ($this->subscribeRepository->unsubscribe($questId, $userId)) {
            return SubscribeStatus::Success;
        }

        return SubscribeStatus::NonSubscribed;
    }
}
