<?php

namespace App\Quest\Infrastructure\ORM;

use App\Quest\Infrastructure\Repository\QuestRepository;
use App\Shared\Infrastructure\ORM\FileORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
#[ORM\Table(name: 'quests')]
class QuestORM
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $description;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateEvent;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $dateFinalAppointment;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $seatsCount = null;

    #[ORM\ManyToOne(targetEntity: GenreORM::class, inversedBy: 'genre')]
    private ?GenreORM $genre = null;

    #[ORM\ManyToMany(targetEntity: ThemeORM::class, inversedBy: 'themes')]
    #[ORM\JoinTable(
        name: 'quest_to_theme',
        joinColumns: new ORM\JoinColumn(name: 'quest_id', referencedColumnName: 'id'),
        inverseJoinColumns: new ORM\JoinColumn(name: 'theme_id', referencedColumnName: 'id')
    )]
    private Collection $themes;

    #[ORM\ManyToMany(targetEntity: TagORM::class, inversedBy: 'tags')]
    #[ORM\JoinTable(
        name: 'quest_to_tag',
        joinColumns: new ORM\JoinColumn(name: 'quest_id', referencedColumnName: 'id'),
        inverseJoinColumns: new ORM\JoinColumn(name: 'tag_id', referencedColumnName: 'id')
    )]
    private Collection $tags;

    #[ORM\ManyToMany(targetEntity: FileORM::class, inversedBy: 'gallery')]
    #[ORM\JoinTable(
        name: 'quest_to_photo',
        joinColumns: new ORM\JoinColumn(name: 'quest_id', referencedColumnName: 'id'),
        inverseJoinColumns: new ORM\JoinColumn(name: 'file_id', referencedColumnName: 'id')
    )]
    private Collection $gallery;

    public function __construct()
    {
        $this->id = Uuid::v4();

        $this->themes = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->gallery = new ArrayCollection();
    }

    public function getId(): Uuid
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

    public function getGenre(): ?GenreORM
    {
        return $this->genre;
    }

    public function setGenre(?GenreORM $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(ThemeORM $theme): self
    {
        $this->themes->add($theme);

        return $this;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(TagORM $tag): self
    {
        $this->tags->add($tag);

        return $this;
    }

    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(FileORM $gallery): self
    {
        $this->gallery->add($gallery);

        return $this;
    }

    public function setGallery(Collection $gallery): self
    {
        $this->gallery = $gallery;

        return $this;
    }
}
