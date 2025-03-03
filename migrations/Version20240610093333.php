<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610093333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_e5adc14dbf396750');
        $this->addSql('ALTER TABLE codes DROP CONSTRAINT codes_pkey');
        $this->addSql('ALTER TABLE codes ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX codes_pkey');
        $this->addSql('CREATE UNIQUE INDEX uniq_e5adc14dbf396750 ON codes (id)');
        $this->addSql('ALTER TABLE codes ADD PRIMARY KEY (id, user_id)');
    }
}
