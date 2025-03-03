<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\AddToFavorite;

use App\Shared\Application\Command\Command;

readonly class AddToFavoriteCommand extends Command
{
    public function __construct(public string $questId)
    {
    }
}
