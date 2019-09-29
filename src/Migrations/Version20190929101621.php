<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190929101621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trip_measures ADD CONSTRAINT FK_F8DB2F45A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trips (id)');
        $this->addSql('CREATE INDEX IDX_F8DB2F45A5BC2E0E ON trip_measures (trip_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trip_measures DROP FOREIGN KEY FK_F8DB2F45A5BC2E0E');
        $this->addSql('DROP INDEX IDX_F8DB2F45A5BC2E0E ON trip_measures');
    }
}
