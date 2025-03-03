<?php

declare(strict_types=1);

namespace App\User\Application\Security;

enum Role: string
{
    case USER = 'USER';

    public const ROLES = [
        self::USER,
    ];
}
