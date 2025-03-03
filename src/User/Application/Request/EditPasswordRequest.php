<?php

declare(strict_types=1);

namespace App\User\Application\Request;

use Symfony\Component\Validator\Constraints as Assert;

class EditPasswordRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    private string $newPassword;

    #[Assert\NotBlank]
    #[Assert\EqualTo(propertyPath: 'newPassword', message: 'This value should be equal to new password field')]
    private string $confirmPassword;

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}
