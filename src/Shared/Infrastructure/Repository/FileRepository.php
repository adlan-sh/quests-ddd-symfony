<?php

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Domain\Entity\File;
use App\Shared\Domain\Repository\FileRepositoryInterface;
use App\Shared\Infrastructure\ORM\FileORM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FileRepository extends ServiceEntityRepository implements FileRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileORM::class);
    }

    public function create(array $file): File
    {
        $fileOrm = (new FileORM())
            ->setName($file['name'])
            ->setUrl($file['url']);

        $this->getEntityManager()->persist($fileOrm);

        $this->getEntityManager()->flush();

        return $this->getById($fileOrm->getId());
    }

    public function getById(string $id): ?File
    {
        $file = null;
        $fileOrm = $this->find($id);

        if (null !== $fileOrm) {
            $file = new File(
                $fileOrm->getId(),
                $fileOrm->getName(),
                $fileOrm->getUrl(),
            );
        }

        return $file;
    }
}
