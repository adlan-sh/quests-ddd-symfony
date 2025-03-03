<?php

declare(strict_types=1);

namespace App\Quest\Domain\Service;

use App\Quest\Domain\Aggregation\Quest;
use App\Quest\Domain\Exception\QuestNotFoundException;
use App\Quest\Domain\Repository\QuestRepositoryInterface;
use App\Shared\Domain\Entity\Pagination;
use App\Shared\Domain\Service\CacheServiceInterface;

readonly class QuestService
{
    public function __construct(
        private QuestRepositoryInterface $questRepository,
        private Pagination $pagination,
        private CacheServiceInterface $cacheService
    ) {
    }

    public function getQuestById(string $id): Quest
    {
        if ($this->cacheService->exists('quest:'.$id)) {
            return $this->cacheService->get('quest:'.$id, Quest::class);
        }

        $quest = $this->questRepository->getById($id);

        if (null === $quest) {
            throw new QuestNotFoundException();
        }

        $this->cacheService->set('quest:'.$id, $quest);

        return $quest;
    }

    public function getQuests(
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array {
        $totalCount = $this->questRepository->getTotalCount();

        $this->pagination->setPage($page);
        $this->pagination->setLimit($limit);
        $this->pagination->setTotalCount($totalCount);

        $quests = $this->questRepository->getAllByPage($page, $limit, $sort, $filter, $search);

        return [
            'pagination' => $this->pagination->getPaginate(),
            'list' => $quests,
        ];
    }

    public function getCompleted(
        string $userId,
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array {
        $totalCount = $this->questRepository->getTotalCountCompletedQuestsForUser($userId);

        $this->pagination->setPage($page);
        $this->pagination->setLimit($limit);
        $this->pagination->setTotalCount($totalCount);

        $quests = $this->questRepository->getCompletedByPage($userId, $page, $limit, $sort, $filter, $search);

        return [
            'pagination' => $this->pagination->getPaginate(),
            'list' => $quests,
        ];
    }
}
