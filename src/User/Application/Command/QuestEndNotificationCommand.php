<?php

declare(strict_types=1);

namespace App\User\Application\Command;

use App\User\Application\Message\QuestEndNotification\QuestEndNotificationMessage;
use App\User\Domain\Service\UserNotificationService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand('app:notify:quest_end')]
class QuestEndNotificationCommand extends Command
{
    public function __construct(
        private readonly UserNotificationService $notificationService,
        private readonly MessageBusInterface $messageBus,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('dry-run', null, InputOption::VALUE_NONE, 'Dry run');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->notificationService->getEmailsAndQuestsForQuestEndNotification();

        foreach ($result as $item) {
            $this->messageBus->dispatch(new QuestEndNotificationMessage($item['email'], $item['name']));
        }

        return Command::SUCCESS;
    }
}
