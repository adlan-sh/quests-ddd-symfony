<?php

namespace App\User\Domain\Entity;

use App\Shared\Domain\ValueObject\Photo;
use App\User\Domain\ValueObject\FullName;

class User
{
    private ?string $phone = null;

    private ?Photo $photo = null;

    private bool $isConfirmed = false;

    public function __construct(
        private readonly string $id,
        private FullName $fullName,
        private string $email,
        private string $password
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFullName(): FullName
    {
        return $this->fullName;
    }

    public function setFullName(FullName $fullName): self
    {
        $this->fullName = $fullName;

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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }
}
