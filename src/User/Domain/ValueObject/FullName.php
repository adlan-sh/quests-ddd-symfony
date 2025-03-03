<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

readonly class FullName
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public ?string $middleName = null
    ) {
    }
}
