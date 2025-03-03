<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

interface MailServiceInterface
{
    public function sendRegisterEmail(string $email, int $code): void;

    public function sendEmailEdited(string $email, int $code): void;

    public function sendEmailQuestStart(string $email, string $questName): void;

    public function sendEmailQuestEnd(string $email, string $questName): void;
}
