<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\RemoveFromFavorite;

use App\Shared\Application\UseCase\CommandResultInterface;

readonly class RemoveFromFavoriteCommandResult implements CommandResultInterface
{
    public function __construct(private int $code)
    {
    }

    public function getResult(): array
    {
        return [
            'message' => 'Removed from favorite successfully.',
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
