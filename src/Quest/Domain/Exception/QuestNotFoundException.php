<?php

declare(strict_types=1);

namespace App\Quest\Domain\Exception;

class QuestNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Quest not found');
    }
}
