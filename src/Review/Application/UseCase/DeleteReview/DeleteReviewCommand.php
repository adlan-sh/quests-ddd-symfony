<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\DeleteReview;

use App\Shared\Application\Command\Command;

readonly class DeleteReviewCommand extends Command
{
    public function __construct(public string $reviewId)
    {
    }
}
