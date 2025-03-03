<?php

declare(strict_types=1);

namespace App\Quest\Application\UseCase\AddToFavorite;

use App\Shared\Application\UseCase\CommandResultInterface;

readonly class AddToFavoriteCommandResult implements CommandResultInterface
{
    public function __construct(private int $code)
    {
    }

    public function getResult(): array
    {
        return [
            'message' => 'Add to favorite successfully',
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
