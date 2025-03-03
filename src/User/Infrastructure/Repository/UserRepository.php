<?php

namespace App\User\Infrastructure\Repository;

use App\Shared\Domain\ValueObject\Photo;
use App\Shared\Infrastructure\ORM\FileORM;
use App\User\Application\Security\Role;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\FullName;
use App\User\Infrastructure\ORM\UserORM;
use App\User\Infrastructure\Service\PasswordHasher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly PasswordHasher $hasher
    ) {
        parent::__construct($registry, UserORM::class);
    }

    public function create(array $user): string
    {
        $userOrm = (new UserORM())
            ->setFirstName($user['firstName'])
            ->setLastName($user['lastName'])
            ->setMiddleName($user['middleName'])
            ->setEmail($user['email'])
            ->setPhone($user['phone'])
            ->addRole(Role::USER);

        $userOrm->setPassword($this->hasher->hash($userOrm, $user['password']));

        $this->getEntityManager()->persist($userOrm);
        $this->getEntityManager()->flush();

        return $userOrm->getId();
    }

    public function existsByParam(string $name, string $value): bool
    {
        return null !== $this->findOneBy([$name => $value]);
    }

    public function existsByEmailOrPhone(string $email, string $phone): bool
    {
        $query = $this->createQueryBuilder('u')
            ->where('u.email = :email OR u.phone = :phone')
            ->setParameter('email', $email)
            ->setParameter('phone', $phone);

        return count($query->getQuery()->getResult()) > 0;
    }

    public function emailAndPhoneNotBusy(string $id, string $email, string $phone): bool
    {
        $query = $this->createQueryBuilder('u')
            ->where('(u.email = :email OR u.phone = :phone) AND u.id <> :id')
            ->setParameter('email', $email)
            ->setParameter('phone', $phone)
            ->setParameter('id', $id);

        return count($query->getQuery()->getResult()) <= 0;
    }

    public function findByParam(string $name, string $value): ?User
    {
        $user = null;
        /** @var UserORM $userOrm */
        $userOrm = $this->findOneBy([$name => $value]);

        if (null !== $userOrm) {
            $user = (new User(
                $userOrm->getId(),
                new FullName(
                    $userOrm->getFirstName(),
                    $userOrm->getLastName(),
                    $userOrm->getMiddleName(),
                ),
                $userOrm->getEmail(),
                $userOrm->getPassword()
            ))
            ->setPhone($userOrm->getPhone());

            if (null !== $userOrm->getPhoto()) {
                $user->setPhoto(
                    new Photo(
                        $userOrm->getPhoto()->getUrl()
                    )
                );
            }
        }

        return $user;
    }

    public function edit(User $user, ?array $file): User
    {
        /** @var UserORM $userOrm */
        $userOrm = $this->find($user->getId());

        $userOrm->setFirstName($user->getFullName()->firstName);
        $userOrm->setLastName($user->getFullName()->lastName);
        $userOrm->setMiddleName($user->getFullName()->middleName);
        $userOrm->setEmail($user->getEmail());
        $userOrm->setPhone($user->getPhone());
        $userOrm->setConfirmed($user->isConfirmed());

        if (null === $file) {
            $userOrm->setPhoto(null);
        } else {
            $userOrm->setPhoto(
                (new FileORM())
                    ->setName($file['name'])
                    ->setUrl($file['url'])
            );
        }

        $this->getEntityManager()->persist($userOrm);

        $this->getEntityManager()->flush();

        return $user;
    }

    public function delete(string $id): string
    {
        /** @var UserORM $userOrm */
        $userOrm = $this->find($id);

        if (null !== $userOrm) {
            $userOrm->setActive(false);

            $this->getEntityManager()->persist($userOrm);

            $this->getEntityManager()->flush();
        }

        return $userOrm->getId();
    }

    public function editPassword(User $user, string $newPassword): string
    {
        $userOrm = $this->find($user->getId());

        if (null !== $userOrm) {
            $userOrm->setPassword($this->hasher->hash($userOrm, $newPassword));
        }

        return $user->getId();
    }

    public function confirm(string $userId): void
    {
        /** @var UserORM $userOrm */
        $userOrm = $this->find($userId);

        if (null !== $userOrm) {
            $userOrm->setConfirmed(true);

            $this->getEntityManager()->persist($userOrm);
            $this->getEntityManager()->flush();
        }
    }

    public function getEmailsAndQuestsSubscribedUsers(): array
    {
        $query = 'SELECT u.email, q.name, q.dateEvent FROM App\Quest\Infrastructure\ORM\SubscribeORM s LEFT JOIN App\Quest\Infrastructure\ORM\QuestORM q WITH q.id = s.questId LEFT JOIN App\User\Infrastructure\ORM\UserORM u WITH u.id = s.userId WHERE q.dateEvent > CURRENT_DATE()';

        return $this->getEntityManager()->createQuery($query)->getResult();
    }

    public function getEmailsAndEndedQuestsSubscribedUsers(): array
    {
        $query = 'SELECT u.email, q.name, q.dateEvent FROM App\Quest\Infrastructure\ORM\SubscribeORM s LEFT JOIN App\Quest\Infrastructure\ORM\QuestORM q WITH q.id = s.questId LEFT JOIN App\User\Infrastructure\ORM\UserORM u WITH u.id = s.userId WHERE q.dateEvent <= CURRENT_DATE()';

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}
