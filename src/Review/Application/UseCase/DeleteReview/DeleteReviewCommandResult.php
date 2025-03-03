<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\DeleteReview;

use App\Shared\Application\UseCase\CommandResultInterface;

readonly class DeleteReviewCommandResult implements CommandResultInterface
{
    public function __construct(public int $code)
    {
    }

    public function getResult(): string
    {
        return 'Review was deleted';
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
