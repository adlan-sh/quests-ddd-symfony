<?php

declare(strict_types=1);

namespace App\Review\Application\Mapper;

use App\Review\Application\Model\ReviewListItemDTO;
use App\Review\Domain\Aggregation\Review;
use App\Shared\Application\Model\PaginationDTO;

class ReviewMapper
{
    public static function toReviewListDTO(array $reviewList): array
    {
        return array_map(
            static function (Review $review) {
                return ReviewMapper::toReviewListItemDTO($review);
            }, $reviewList
        );
    }

    public static function toReviewListItemDTO(Review $review): ReviewListItemDTO
    {
        return (new ReviewListItemDTO())
            ->setId($review->getId())
            ->setDate($review->getDate())
            ->setText($review->getText())
            ->setScore($review->getScore());
    }

    public static function toPaginationDTO(array $pagination): PaginationDTO
    {
        return new PaginationDTO(
            $pagination['currentPage'],
            $pagination['totalCount'],
            $pagination['pageSize'],
        );
    }
}
