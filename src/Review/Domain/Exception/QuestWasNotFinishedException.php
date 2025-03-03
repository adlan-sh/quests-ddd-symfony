<?php

declare(strict_types=1);

namespace App\Review\Domain\Exception;

class QuestWasNotFinishedException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('This quest is not over yet.');
    }
}
