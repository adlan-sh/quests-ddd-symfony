<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604111431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites (id UUID NOT NULL, quest_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN favorites.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN favorites.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN favorites.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE subscribes (id UUID NOT NULL, quest_id UUID NOT NULL, user_id UUID NOT NULL, date_subscribe TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN subscribes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscribes.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscribes.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN subscribes.date_subscribe IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE subscribes');
    }
}
