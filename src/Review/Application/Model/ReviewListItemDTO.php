<?php

declare(strict_types=1);

namespace App\Review\Application\Model;

class ReviewListItemDTO implements \JsonSerializable
{
    private string $id;

    private \DateTimeImmutable $date;

    private int $score;

    private string $text;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date->format('d-m-Y'),
            'score' => $this->score,
            'text' => $this->text,
        ];
    }
}
