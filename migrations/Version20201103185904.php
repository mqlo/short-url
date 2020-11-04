<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103185904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE urls (id UUID NOT NULL, source VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, clicks SMALLINT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A9437A1D1B862B8 ON urls (hash)');
        $this->addSql('COMMENT ON COLUMN urls.id IS \'(DC2Type:url_id)\'');
        $this->addSql('COMMENT ON COLUMN urls.source IS \'(DC2Type:url_source)\'');
        $this->addSql('COMMENT ON COLUMN urls.hash IS \'(DC2Type:url_hash)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE urls');
    }
}
