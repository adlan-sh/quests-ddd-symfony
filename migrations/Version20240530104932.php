<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530104932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quests ADD seats_count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quests ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE users ALTER middle_name DROP NOT NULL');
        $this->addSql('ALTER TABLE users ALTER phone DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users ALTER middle_name SET NOT NULL');
        $this->addSql('ALTER TABLE users ALTER phone SET NOT NULL');
        $this->addSql('ALTER TABLE quests DROP seats_count');
        $this->addSql('ALTER TABLE quests ALTER code SET NOT NULL');
    }
}
