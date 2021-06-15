<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615063245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE models DROP CONSTRAINT fk_e4d63009a76ed395');
        $this->addSql('DROP INDEX idx_e4d63009a76ed395');
        $this->addSql('ALTER TABLE models RENAME COLUMN user_id TO owner_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE models RENAME COLUMN owner_id TO user_id');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT fk_e4d63009a76ed395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e4d63009a76ed395 ON models (user_id)');
    }
}
