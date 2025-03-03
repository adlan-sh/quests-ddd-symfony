<?php

declare(strict_types=1);

namespace App\Quest\Application\Model;

use App\Shared\Application\Model\FileDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class QuestListItemDTO implements \JsonSerializable
{
    private string $id;

    private string $name;

    private string $description;

    private \DateTimeImmutable $dateEvent;

    private string $code;

    private ?int $seatsCount = null;

    private ?int $remainingSeats = null;

    private ?string $detailLink = null;

    private ?GenreDTO $genre = null;

    private Collection $themes;

    private Collection $tags;

    private Collection $gallery;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
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

    public function getRemainingSeats(): ?int
    {
        return $this->remainingSeats;
    }

    public function setRemainingSeats(?int $remainingSeats): self
    {
        $this->remainingSeats = $remainingSeats;

        return $this;
    }

    public function getDetailLink(): ?string
    {
        return $this->detailLink;
    }

    public function setDetailLink(?string $code): self
    {
        $this->detailLink = '/quests/'.$code;

        return $this;
    }

    public function getGenre(): ?GenreDTO
    {
        return $this->genre;
    }

    public function setGenre(?GenreDTO $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(ThemeDTO $theme): self
    {
        $this->themes->add($theme);

        return $this;
    }

    public function setThemes(array $themes): self
    {
        $this->themes = new ArrayCollection($themes);

        return $this;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(TagDTO $tag): self
    {
        $this->tags->add($tag);

        return $this;
    }

    public function setTags(array $tags): self
    {
        $this->tags = new ArrayCollection($tags);

        return $this;
    }

    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(FileDTO $gallery): self
    {
        $this->gallery[] = $gallery;

        return $this;
    }

    public function setGallery(array $gallery): self
    {
        $this->gallery = new ArrayCollection($gallery);

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'tags' => $this->getTags()->getValues(),
            'code' => $this->getCode(),
            'theme' => $this->getThemes()->getValues(),
            'genre' => $this->getGenre(),
            'gallery' => $this->getGallery()->getValues(),
            'date_event' => $this->getDateEvent()->format('d.m.Y'),
            'seats_count' => $this->getSeatsCount(),
            'remaining_seats' => $this->getRemainingSeats(),
            'detail_link' => $this->getDetailLink(),
        ];
    }
}
