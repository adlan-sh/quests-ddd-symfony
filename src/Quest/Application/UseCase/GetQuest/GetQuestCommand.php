<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetQuest;

use App\Shared\Application\Command\Command;

readonly class GetQuestCommand extends Command
{
    public function __construct(public string $id)
    {
    }
}
