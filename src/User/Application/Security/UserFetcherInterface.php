<?php

declare(strict_types=1);

namespace App\User\Application\Security;

interface UserFetcherInterface
{
    public function getAuthUser(): AuthUserInterface;
}
