<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\GetUserReviews;

use App\Shared\Application\Command\Command;

readonly class GetUserReviewsCommand extends Command
{
    public function __construct(public int $page, public int $limit)
    {
    }
}
