<?php

declare(strict_types=1);

namespace App\Review\Domain\Exception;

class UserWasNotSubscribedForQuestException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('The user was not subscribed to this quest.');
    }
}
