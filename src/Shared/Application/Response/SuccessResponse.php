<?php

namespace App\Shared\Application\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessResponse extends JsonResponse
{
    public function __construct(protected mixed $data, private readonly int $code)
    {
        $this->data['success'] = true;
        parent::__construct($this->data, $this->code);
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
