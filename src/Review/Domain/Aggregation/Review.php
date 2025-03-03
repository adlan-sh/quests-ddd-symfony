<?php

declare(strict_types=1);

namespace App\Review\Domain\Aggregation;

class Review
{
    public function __construct(
        private readonly string $id,
        private int $score,
        private string $text,
        private \DateTimeImmutable $date,
        private string $quest,
        private string $user
    ) {
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

    public function getQuest(): string
    {
        return $this->quest;
    }

    public function setQuest(string $quest): self
    {
        $this->quest = $quest;

        return $this;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }
}
