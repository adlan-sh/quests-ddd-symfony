<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\AboutMe;

use App\Shared\Application\UseCase\CommandResultInterface;
use App\Shared\Domain\ValueObject\Photo;
use App\User\Application\Model\AboutMeDTO;

class AboutMeCommandResult implements CommandResultInterface
{
    public string $firstName;

    public string $lastName;

    public ?string $middleName = null;

    public string $email;

    public ?string $phone = null;

    public ?Photo $photo = null;

    public function __construct(AboutMeDTO $aboutMeDTO, public int $code)
    {
        $this->firstName = $aboutMeDTO->getFirstName();
        $this->lastName = $aboutMeDTO->getLastName();
        $this->middleName = $aboutMeDTO->getMiddleName();
        $this->email = $aboutMeDTO->getEmail();
        $this->phone = $aboutMeDTO->getPhone();
        $this->photo = $aboutMeDTO->getPhoto();
    }

    public function getResult(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'middleName' => $this->middleName,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => [
                'path' => $this->photo?->getPath(),
            ],
        ];
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
