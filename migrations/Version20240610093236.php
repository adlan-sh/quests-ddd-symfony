<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610093236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE codes DROP CONSTRAINT codes_pkey');
        $this->addSql('ALTER TABLE codes ADD id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN codes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E5ADC14DBF396750 ON codes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E5ADC14DA76ED395 ON codes (user_id)');
        $this->addSql('ALTER TABLE codes ADD PRIMARY KEY (id, user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_E5ADC14DBF396750');
        $this->addSql('DROP INDEX UNIQ_E5ADC14DA76ED395');
        $this->addSql('DROP INDEX codes_pkey');
        $this->addSql('ALTER TABLE codes DROP id');
        $this->addSql('ALTER TABLE codes ADD PRIMARY KEY (user_id)');
    }
}
