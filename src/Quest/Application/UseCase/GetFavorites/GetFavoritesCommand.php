<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\GetFavorites;

use App\Shared\Application\Command\Command;

readonly class GetFavoritesCommand extends Command
{
    public function __construct(
        public int $page,
        public int $limit,
        public string $sort,
        public array $filter,
        public ?string $search
    ) {
    }
}
