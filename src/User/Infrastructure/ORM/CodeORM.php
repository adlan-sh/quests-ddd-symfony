<?php

namespace App\User\Infrastructure\ORM;

use App\User\Infrastructure\Repository\CodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CodeRepository::class)]
#[ORM\Table(name: 'codes')]
class CodeORM
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\Column(type: 'uuid')]
    private Uuid $userId;

    #[ORM\Column(type: 'integer')]
    private int $code;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $endAt;

    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->endAt = (new \DateTimeImmutable('now')
        )->add(new \DateInterval('PT5M'));
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getEndAt(): \DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }
}
