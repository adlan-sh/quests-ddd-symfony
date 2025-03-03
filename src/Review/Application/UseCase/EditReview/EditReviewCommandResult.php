<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\EditReview;

use App\Review\Application\Model\ReviewDTO;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class EditReviewCommandResult implements CommandResultInterface
{
    public function __construct(private ReviewDTO $review, private int $code)
    {
    }

    public function getResult(): array
    {
        return [
            'score' => $this->review->getScore(),
            'text' => $this->review->getText(),
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
