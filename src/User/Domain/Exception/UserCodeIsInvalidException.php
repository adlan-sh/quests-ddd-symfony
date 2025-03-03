<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

class UserCodeIsInvalidException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Code is invalid!');
    }
}
