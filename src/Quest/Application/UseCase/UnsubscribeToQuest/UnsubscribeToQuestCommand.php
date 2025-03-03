<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\UnsubscribeToQuest;

use App\Shared\Application\Command\Command;

readonly class UnsubscribeToQuestCommand extends Command
{
    public function __construct(public string $questId)
    {
    }
}
