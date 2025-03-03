<?php

declare(strict_types=1);

namespace App\Review\Application\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ReviewRequest
{
    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 5)]
    private int $score;

    #[Assert\NotBlank]
    private string $text;

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
}
