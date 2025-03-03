<?php

namespace App\Review\Infrastructure\ORM;

use App\Review\Infrastructure\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\Table(name: 'reviews')]
class ReviewORM
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\Column(type: 'integer')]
    private int $score;

    #[ORM\Column(length: 255)]
    private string $text;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $date;

    #[ORM\Column(type: UuidType::NAME)]
    private Uuid $questId;

    #[ORM\Column(type: UuidType::NAME)]
    private Uuid $userId;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->date = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
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
}
