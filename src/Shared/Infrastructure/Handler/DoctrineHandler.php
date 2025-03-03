<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Handler;

use App\Shared\Infrastructure\ORM\LogORM;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class DoctrineHandler extends AbstractProcessingHandler
{
    private string $channel = 'doctrine';

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function write(LogRecord $record): void
    {
        if ($this->channel !== $record->channel) {
            return;
        }

        if (!array_key_exists('login', $record->context)) {
            return;
        }

        $log = new LogORM();
        $log->setMessage($record->message);
        $log->setLevel($record->level->getName());

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}
