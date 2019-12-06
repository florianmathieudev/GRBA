<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206130758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event ADD place VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE type ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CDE5729EE45BDBF ON type (picture_id)');
        $this->addSql('ALTER TABLE user CHANGE role_id role_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event DROP place');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729EE45BDBF');
        $this->addSql('DROP INDEX UNIQ_8CDE5729EE45BDBF ON type');
        $this->addSql('ALTER TABLE type DROP picture_id');
        $this->addSql('ALTER TABLE user CHANGE role_id role_id INT DEFAULT NULL');
    }
}
