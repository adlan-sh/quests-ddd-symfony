<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\GetUserReviews;

use App\Shared\Application\Model\PaginationDTO;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class GetUserReviewsCommandResult implements CommandResultInterface
{
    public function __construct(
        private PaginationDTO $pagination,
        private array $reviewsList,
        private int $code
    ) {
    }

    public function getResult(): array
    {
        return [
            'pagination' => $this->pagination,
            'list' => $this->reviewsList,
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
