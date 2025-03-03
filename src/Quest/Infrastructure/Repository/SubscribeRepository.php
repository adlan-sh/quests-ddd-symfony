<?php

namespace App\Quest\Infrastructure\Repository;

use App\Quest\Domain\Repository\SubscribeRepositoryInterface;
use App\Quest\Infrastructure\ORM\SubscribeORM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SubscribeRepository extends ServiceEntityRepository implements SubscribeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubscribeORM::class);
    }

    public function hasSeats(string $questId): bool
    {
        $query = 'SELECT COUNT(s.userId) FROM App\Quest\Infrastructure\ORM\SubscribeORM s LEFT JOIN App\Quest\Infrastructure\ORM\QuestORM q WITH q.id = s.questId WHERE q.id = :questId';
        $em = $this->getEntityManager()->createQuery($query);
        $em->setParameter('questId', $questId);

        $takenSeatsCount = $em->getSingleScalarResult();

        $query = 'SELECT q.seatsCount FROM App\Quest\Infrastructure\ORM\QuestORM q WHERE q.id = :questId';
        $em = $this->getEntityManager()->createQuery($query);
        $em->setParameter('questId', $questId);

        $seatsCount = $em->getSingleScalarResult();

        return $takenSeatsCount < $seatsCount;
    }

    public function subscribe(string $questId, string $userId): bool
    {
        $query = 'SELECT s.id FROM App\Quest\Infrastructure\ORM\SubscribeORM s WHERE s.questId = :questId AND s.userId = :userId';

        $em = $this->getEntityManager()->createQuery($query);
        $em->setParameter('questId', $questId);
        $em->setParameter('userId', $userId);

        $subId = $em->getResult();

        if (empty($subId)) {
            $subscribeOrm = (new SubscribeORM())
                ->setQuestId($questId)
                ->setUserId($userId)
                ->setDateSubscribe(new \DateTimeImmutable());

            $this->getEntityManager()->persist($subscribeOrm);
            $this->getEntityManager()->flush();

            return true;
        }

        return false;
    }

    public function unsubscribe(string $questId, string $userId): bool
    {
        $query = 'SELECT s.id FROM App\Quest\Infrastructure\ORM\SubscribeORM s WHERE s.questId = :questId AND s.userId = :userId';

        $em = $this->getEntityManager()->createQuery($query);
        $em->setParameter('questId', $questId);
        $em->setParameter('userId', $userId);

        $subId = $em->getResult();

        if (empty($subId)) {
            return false;
        }

        $query = 'DELETE FROM App\Quest\Infrastructure\ORM\SubscribeORM s WHERE s.id = :id';
        $em = $this->getEntityManager()->createQuery($query);
        $em->setParameter('id', $subId);
        $em->execute();

        return true;
    }
}
