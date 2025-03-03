<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530104034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quest_to_photo (quest_id UUID NOT NULL, file_id UUID NOT NULL, PRIMARY KEY(quest_id, file_id))');
        $this->addSql('CREATE INDEX IDX_FED10A8D209E9EF4 ON quest_to_photo (quest_id)');
        $this->addSql('CREATE INDEX IDX_FED10A8D93CB796C ON quest_to_photo (file_id)');
        $this->addSql('COMMENT ON COLUMN quest_to_photo.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quest_to_photo.file_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE quest_to_photo ADD CONSTRAINT FK_FED10A8D209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quest_to_photo ADD CONSTRAINT FK_FED10A8D93CB796C FOREIGN KEY (file_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE quest_to_photo DROP CONSTRAINT FK_FED10A8D209E9EF4');
        $this->addSql('ALTER TABLE quest_to_photo DROP CONSTRAINT FK_FED10A8D93CB796C');
        $this->addSql('DROP TABLE quest_to_photo');
    }
}
