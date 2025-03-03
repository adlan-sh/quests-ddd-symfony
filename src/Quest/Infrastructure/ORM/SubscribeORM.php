<?php

namespace App\Quest\Infrastructure\ORM;

use App\Quest\Infrastructure\Repository\SubscribeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: SubscribeRepository::class)]
#[ORM\Table(name: 'subscribes')]
class SubscribeORM
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: QuestORM::class, inversedBy: 'id')]
    #[ORM\Column(type: UuidType::NAME)]
    #[ORM\JoinColumn(name: 'quest_id', referencedColumnName: 'id', nullable: false)]
    private Uuid $questId;

    #[ORM\Column(type: UuidType::NAME)]
    private Uuid $userId;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateSubscribe;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestId(): string
    {
        return $this->questId;
    }

    public function setQuestId(string $questId): self
    {
        $this->questId = new Uuid($questId);

        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = new Uuid($userId);

        return $this;
    }

    public function getDateSubscribe(): \DateTimeImmutable
    {
        return $this->dateSubscribe;
    }

    public function setDateSubscribe(\DateTimeImmutable $dateSubscribe): self
    {
        $this->dateSubscribe = $dateSubscribe;

        return $this;
    }
}
