<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\SubscribeToQuest;

use App\Shared\Application\Command\Command;

readonly class SubscribeToQuestCommand extends Command
{
    public function __construct(public string $questId)
    {
    }
}
