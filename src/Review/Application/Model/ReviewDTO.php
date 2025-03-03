<?php

declare(strict_types=1);

namespace App\Review\Application\Model;

class ReviewDTO
{
    public function __construct(private int $score, private string $text)
    {
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
