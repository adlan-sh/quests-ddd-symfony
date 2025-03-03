<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\AddReview;

use App\Shared\Application\Command\Command;

readonly class AddReviewCommand extends Command
{
    public function __construct(public int $score, public string $text, public string $questId)
    {
    }
}
