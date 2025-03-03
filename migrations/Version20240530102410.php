<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240530102410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE files (id UUID NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN files.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE genres (id UUID NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN genres.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quests (id UUID NOT NULL, genre_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_event TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_final_appointment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_989E5D344296D31F ON quests (genre_id)');
        $this->addSql('COMMENT ON COLUMN quests.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.genre_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quests.date_event IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN quests.date_final_appointment IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE quest_to_theme (quest_id UUID NOT NULL, theme_id UUID NOT NULL, PRIMARY KEY(quest_id, theme_id))');
        $this->addSql('CREATE INDEX IDX_7D13699D209E9EF4 ON quest_to_theme (quest_id)');
        $this->addSql('CREATE INDEX IDX_7D13699D59027487 ON quest_to_theme (theme_id)');
        $this->addSql('COMMENT ON COLUMN quest_to_theme.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quest_to_theme.theme_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE quest_to_tag (quest_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(quest_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_AC5F1D7B209E9EF4 ON quest_to_tag (quest_id)');
        $this->addSql('CREATE INDEX IDX_AC5F1D7BBAD26311 ON quest_to_tag (tag_id)');
        $this->addSql('COMMENT ON COLUMN quest_to_tag.quest_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN quest_to_tag.tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE refresh_token (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F2195C74F2195 ON refresh_token (refresh_token)');
        $this->addSql('CREATE TABLE tags (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tags.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE themes (id UUID NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN themes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, photo_id UUID DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles TEXT NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E97E9E4C8C ON users (photo_id)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.photo_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE quests ADD CONSTRAINT FK_989E5D344296D31F FOREIGN KEY (genre_id) REFERENCES genres (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quest_to_theme ADD CONSTRAINT FK_7D13699D209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quest_to_theme ADD CONSTRAINT FK_7D13699D59027487 FOREIGN KEY (theme_id) REFERENCES themes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quest_to_tag ADD CONSTRAINT FK_AC5F1D7B209E9EF4 FOREIGN KEY (quest_id) REFERENCES quests (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quest_to_tag ADD CONSTRAINT FK_AC5F1D7BBAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E97E9E4C8C FOREIGN KEY (photo_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('ALTER TABLE quests DROP CONSTRAINT FK_989E5D344296D31F');
        $this->addSql('ALTER TABLE quest_to_theme DROP CONSTRAINT FK_7D13699D209E9EF4');
        $this->addSql('ALTER TABLE quest_to_theme DROP CONSTRAINT FK_7D13699D59027487');
        $this->addSql('ALTER TABLE quest_to_tag DROP CONSTRAINT FK_AC5F1D7B209E9EF4');
        $this->addSql('ALTER TABLE quest_to_tag DROP CONSTRAINT FK_AC5F1D7BBAD26311');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E97E9E4C8C');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE quests');
        $this->addSql('DROP TABLE quest_to_theme');
        $this->addSql('DROP TABLE quest_to_tag');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE themes');
        $this->addSql('DROP TABLE users');
    }
}
