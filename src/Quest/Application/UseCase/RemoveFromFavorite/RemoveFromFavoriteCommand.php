<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\RemoveFromFavorite;

use App\Shared\Application\Command\Command;

readonly class RemoveFromFavoriteCommand extends Command
{
    public function __construct(public string $questId)
    {
    }
}
