<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

readonly class MailService implements MailServiceInterface
{
    private const FROM = 'stud0000262945@utmn.ru';

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendRegisterEmail(string $email, int $code): void
    {
        $message = new Email();

        $message->from(self::FROM);
        $message->to($email);
        $message->text('Success registered! Your verification code is: '.$code);
        $message->subject('Quest');

        $this->mailer->send($message);
    }

    public function sendEmailEdited(string $email, int $code): void
    {
        $message = new Email();

        $message->from(self::FROM);
        $message->to($email);
        $message->text('Your email was edited! Your verification code is: '.$code);
        $message->subject('Quest');

        $this->mailer->send($message);
    }

    public function sendEmailQuestStart(string $email, string $questName): void
    {
        $message = new Email();

        $message->from(self::FROM);
        $message->to($email);
        $message->text("Hello! Your quest \"$questName\" starts in three days. Don't forget!");
        $message->subject('Quest');

        $this->mailer->send($message);
    }

    public function sendEmailQuestEnd(string $email, string $questName): void
    {
        $message = new Email();

        $message->from(self::FROM);
        $message->to($email);
        $message->text("Thanks for you for choosing us! Please leave a review for quest $questName !");
        $message->subject('Quest');

        $this->mailer->send($message);
    }
}
