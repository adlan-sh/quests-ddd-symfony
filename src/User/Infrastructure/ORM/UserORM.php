<?php

namespace App\User\Infrastructure\ORM;

use App\Shared\Infrastructure\ORM\FileORM;
use App\User\Application\Security\AuthUserInterface;
use App\User\Application\Security\Role;
use App\User\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class UserORM implements AuthUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $middleName = null;

    #[ORM\Column(length: 255)]
    private string $email;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\Column(type: 'simple_array')]
    private array $roles = [];

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    #[ORM\Column(type: 'boolean')]
    private bool $isConfirmed = false;

    #[ORM\OneToOne(targetEntity: FileORM::class, cascade: ['persist'])]
    private ?FileORM $photo = null;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!in_array($role, Role::ROLES, true)) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role->value;
        }

        return $this;
    }

    public function getPhoto(): ?FileORM
    {
        return $this->photo;
    }

    public function setPhoto(?FileORM $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    public function setConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }
}
