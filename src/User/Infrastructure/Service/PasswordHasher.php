<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Service;

use App\User\Infrastructure\ORM\UserORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class PasswordHasher
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function hash(UserORM $user, string $password): string
    {
        return $this->hasher->hashPassword($user, $password);
    }
}
