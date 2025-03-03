<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240605114039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reviews (id UUID NOT NULL, score INT NOT NULL, text VARCHAR(255) NOT NULL, quest_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reviews.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reviews.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN reviews.user_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE reviews');
    }
}
