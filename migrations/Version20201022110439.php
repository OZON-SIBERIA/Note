<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022110439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE call (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number_from_id INTEGER DEFAULT NULL, number_to_id INTEGER DEFAULT NULL, made_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_CC8E2F3EF5CED9E ON call (number_from_id)');
        $this->addSql('CREATE INDEX IDX_CC8E2F3E8B7CC9AD ON call (number_to_id)');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text VARCHAR(1024) NOT NULL, created_at DATETIME NOT NULL, attached_at INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE tel_number (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, number VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE call');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE tel_number');
    }
}
