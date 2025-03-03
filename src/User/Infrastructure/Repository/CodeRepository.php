<?php

namespace App\User\Infrastructure\Repository;

use App\User\Domain\Repository\CodeRepositoryInterface;
use App\User\Infrastructure\ORM\CodeORM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CodeRepository extends ServiceEntityRepository implements CodeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeORM::class);
    }

    public function save(string $userId, int $code): void
    {
        $codeOrm = (new CodeORM())
            ->setUserId($userId)
            ->setCode($code);

        $this->getEntityManager()->persist($codeOrm);
        $this->getEntityManager()->flush();
    }

    public function isValid(string $userId, string $code): bool
    {
        /** @var CodeORM $codeOrm */
        $codeOrm = $this->findOneBy(['userId' => $userId, 'code' => $code]);

        if (null === $codeOrm) {
            return false;
        }

        if ($codeOrm->getEndAt() < new \DateTimeImmutable('now')
        ) {
            return false;
        }

        return true;
    }
}
