<?php

declare(strict_types=1);

namespace App\Quest\Domain\Service;

use App\Quest\Domain\Repository\FavoriteRepositoryInterface;
use App\Shared\Domain\Entity\Pagination;

readonly class FavoriteService
{
    public function __construct(
        private FavoriteRepositoryInterface $favoriteRepository,
        private Pagination $pagination
    ) {
    }

    public function addToFavorite(string $questId, string $userId): void
    {
        $this->favoriteRepository->add($questId, $userId);
    }

    public function removeFromFavorite(string $questId, string $userId): void
    {
        $this->favoriteRepository->remove($questId, $userId);
    }

    public function getFavorites(
        string $userId,
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array {
        $totalCount = $this->favoriteRepository->getTotalCount($userId);

        $this->pagination->setPage($page);
        $this->pagination->setLimit($limit);
        $this->pagination->setTotalCount($totalCount);

        $quests = $this->favoriteRepository->getAllByPage($userId, $page, $limit, $sort, $filter, $search);

        return [
            'pagination' => $this->pagination->getPaginate(),
            'list' => $quests,
        ];
    }
}
