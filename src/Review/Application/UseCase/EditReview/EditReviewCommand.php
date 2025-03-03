<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\EditReview;

use App\Shared\Application\Command\Command;

readonly class EditReviewCommand extends Command
{
    public function __construct(public int $score, public string $text, public string $reviewId)
    {
    }
}
