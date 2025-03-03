<?php

declare(strict_types=1);

namespace App\Quest\Domain\Entity;

class Genre
{
    public function __construct(
        private readonly string $id,
        private string $name,
        private string $code
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
