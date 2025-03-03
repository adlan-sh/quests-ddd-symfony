<?php

declare(strict_types=1);

namespace App\Quest\Domain\Aggregation;

use App\Quest\Domain\Entity\Genre;
use App\Quest\Domain\Entity\Tag;
use App\Quest\Domain\Entity\Theme;
use App\Shared\Domain\ValueObject\Photo;

class Quest
{
    private ?string $code = null;

    private ?int $seatsCount = null;

    private ?Genre $genre = null;

    /** @var string[] */
    private array $themes;

    /** @var string[] */
    private array $tags;

    /** @var string[] */
    private array $gallery;

    public function __construct(
        private readonly string $id,
        private string $name,
        private string $description,
        private \DateTimeImmutable $dateEvent,
        private \DateTimeImmutable $dateFinalAppointment,
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateEvent(): \DateTimeImmutable
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeImmutable $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getDateFinalAppointment(): \DateTimeImmutable
    {
        return $this->dateFinalAppointment;
    }

    public function setDateFinalAppointment(\DateTimeImmutable $dateFinalAppointment): self
    {
        $this->dateFinalAppointment = $dateFinalAppointment;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSeatsCount(): ?int
    {
        return $this->seatsCount;
    }

    public function setSeatsCount(?int $seatsCount): self
    {
        $this->seatsCount = $seatsCount;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getThemes(): array
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        $this->themes[] = $theme;

        return $this;
    }

    public function setThemes(array $themes): self
    {
        $this->themes = $themes;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getGallery(): array
    {
        return $this->gallery;
    }

    public function addGallery(Photo $gallery): self
    {
        $this->gallery[] = $gallery;

        return $this;
    }

    public function setGallery(array $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }
}
