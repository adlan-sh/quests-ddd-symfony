<?php

declare(strict_types=1);

namespace App\Review\Infrastructure\Repository;

use App\Review\Domain\Aggregation\Review;
use App\Review\Domain\Repository\ReviewRepositoryInterface;
use App\Review\Infrastructure\ORM\ReviewORM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository implements ReviewRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReviewORM::class);
    }

    public function create(array $review): Review
    {
        $reviewOrm = (new ReviewORM())
            ->setScore($review['score'])
            ->setText($review['text'])
            ->setQuestId($review['questId'])
            ->setUserId($review['userId']);

        $this->getEntityManager()->persist($reviewOrm);
        $this->getEntityManager()->flush();

        return new Review(
            $reviewOrm->getId(),
            $reviewOrm->getScore(),
            $reviewOrm->getText(),
            $reviewOrm->getDate(),
            $reviewOrm->getQuestId(),
            $reviewOrm->getUserId()
        );
    }

    public function isExists(string $questId, string $userId): bool
    {
        return null !== $this->findOneBy(['userId' => $userId, 'questId' => $questId]);
    }

    public function isSubscribed(string $questId, string $userId): bool
    {
        $query = 'SELECT s.id FROM App\Quest\Infrastructure\ORM\SubscribeORM s WHERE s.userId = :userId AND s.questId = :questId';

        $result = $this->getEntityManager()
            ->createQuery($query)
            ->setParameter('userId', $userId)
            ->setParameter('questId', $questId)
            ->getResult();

        if (empty($result)) {
            return false;
        }

        return true;
    }

    public function questFinished(string $questId): bool
    {
        $query = 'SELECT q.dateEvent FROM App\Quest\Infrastructure\ORM\QuestORM q WHERE q.id = :questId';

        $dateEvent = $this->getEntityManager()
            ->createQuery($query)
            ->setParameter('questId', $questId)
            ->getSingleScalarResult();

        return new \DateTimeImmutable($dateEvent) <= new \DateTimeImmutable();
    }

    public function getUserReviews(string $userId, int $page, int $limit): array
    {
        $query = $this->createQueryBuilder('r');
        $query->select('r');
        $query->where('r.userId = :userId')->setParameter('userId', $userId);

        $query->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $reviews = $query->getQuery()->getResult();

        return array_map(
            static function (ReviewORM $review) {
                return new Review(
                    $review->getId(),
                    $review->getScore(),
                    $review->getText(),
                    $review->getDate(),
                    $review->getQuestId(),
                    $review->getUserId()
                );
            }, $reviews
        );
    }

    public function getTotalCountForUser(string $userId): int
    {
        return $this->count(['userId' => $userId]);
    }

    public function isExistsById(string $reviewId): bool
    {
        return null !== $this->find($reviewId);
    }

    public function editReview(string $reviewId, int $score, string $text): Review
    {
        /** @var ReviewORM $reviewOrm */
        $reviewOrm = $this->find($reviewId);

        $reviewOrm->setScore($score);
        $reviewOrm->setText($text);

        $this->getEntityManager()->persist($reviewOrm);
        $this->getEntityManager()->flush();

        return new Review(
            $reviewOrm->getId(),
            $reviewOrm->getScore(),
            $reviewOrm->getText(),
            $reviewOrm->getDate(),
            $reviewOrm->getQuestId(),
            $reviewOrm->getUserId()
        );
    }

    public function deleteReview(string $reviewId): void
    {
        $this->getEntityManager()->remove($this->find($reviewId));
    }
}
