<?php

declare(strict_types=1);

namespace App\User\Application\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UserCodeRequest
{
    #[Assert\Type('int')]
    #[Assert\NotBlank]
    #[Assert\Length(6)]
    private int $code;

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }
}
