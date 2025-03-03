<?php

namespace App\Quest\Infrastructure\Repository;

use App\Quest\Domain\Aggregation\Quest;
use App\Quest\Domain\Entity\Genre;
use App\Quest\Domain\Entity\Tag;
use App\Quest\Domain\Entity\Theme;
use App\Quest\Domain\Repository\FavoriteRepositoryInterface;
use App\Quest\Infrastructure\ORM\FavoriteORM;
use App\Quest\Infrastructure\ORM\QuestORM;
use App\Quest\Infrastructure\ORM\TagORM;
use App\Quest\Infrastructure\ORM\ThemeORM;
use App\Shared\Application\Exception\RequestQueryConvertException;
use App\Shared\Domain\Entity\File;
use App\Shared\Infrastructure\ORM\FileORM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class FavoriteRepository extends ServiceEntityRepository implements FavoriteRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoriteORM::class);
    }

    public function add(string $questId, string $userId): void
    {
        $isExist = $this->findOneBy(['questId' => $questId, 'userId' => $userId]);

        if (null === $isExist) {
            $favoriteOrm = (new FavoriteORM())
                ->setQuestId($questId)
                ->setUserId($userId);

            $this->getEntityManager()->persist($favoriteOrm);
            $this->getEntityManager()->flush();
        }
    }

    public function remove(string $questId, string $userId): void
    {
        $isExist = $this->findOneBy(['questId' => $questId, 'userId' => $userId]);

        if (null !== $isExist) {
            $this->getEntityManager()->remove($isExist);
            $this->getEntityManager()->flush();
        }
    }

    public function getTotalCount(string $userId): int
    {
        return $this->count(['userId' => $userId]);
    }

    public function getAllByPage(
        string $userId,
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array {
        $query = $this->createQueryBuilder('f');
        $query->select('q');
        $query->leftJoin(QuestORM::class, 'q', Join::WITH, 'q.id = f.questId');
        $query->where('f.userId = :userId');
        $query->setParameter(':userId', $userId);
        $query->orderBy('q.name', $sort);

        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                $query->join('q.'.$key, $key);
                $query->andWhere($key.'.name = \''.$value.'\'');
            }
        }

        if (null !== $search) {
            $query->andWhere('LOWER(q.name) LIKE :search');
            $query->setParameter('search', '%'.$search.'%');
        }

        $query->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        try {
            $result = $query->getQuery()->getResult();
        } catch (\Throwable $e) {
            throw new RequestQueryConvertException();
        }

        return array_map(
            function (QuestORM $questOrm) {
                return $this->mapFromORM($questOrm);
            }, $result
        );
    }

    private function mapFromORM(QuestORM $questOrm): Quest
    {
        $quest = (new Quest(
            $questOrm->getId(),
            $questOrm->getName(),
            $questOrm->getDescription(),
            $questOrm->getDateEvent(),
            $questOrm->getDateFinalAppointment()
        ))
            ->setCode($questOrm->getCode())
            ->setSeatsCount($questOrm->getSeatsCount())
            ->setThemes(
                $questOrm->getThemes()->map(
                    fn (ThemeORM $theme) => new Theme(
                        $theme->getId(),
                        $theme->getName(),
                        $theme->getCode()
                    ))
                    ->toArray()
            )
            ->setTags(
                $questOrm->getTags()->map(
                    fn (TagORM $tag) => new Tag(
                        $tag->getId(),
                        $tag->getName()
                    ))
                    ->toArray()
            )
            ->setGallery(
                $questOrm->getGallery()->map(
                    fn (FileORM $file) => new File(
                        $file->getId(),
                        $file->getName(),
                        $file->getUrl()
                    ))
                    ->toArray()
            );

        if (null !== $questOrm->getGenre()) {
            $quest->setGenre(
                new Genre(
                    $questOrm->getGenre()->getId(),
                    $questOrm->getGenre()->getName(),
                    $questOrm->getGenre()->getCode()
                )
            );
        }

        return $quest;
    }
}
