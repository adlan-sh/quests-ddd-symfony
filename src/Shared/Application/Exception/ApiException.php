<?php

declare(strict_types=1);

namespace App\Shared\Application\Exception;

class ApiException extends \Exception
{
    public function __construct(public $message, public $code)
    {
        parent::__construct($message, $this->code);
    }
}
