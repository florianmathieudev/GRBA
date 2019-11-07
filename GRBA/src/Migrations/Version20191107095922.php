<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107095922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE header ADD picture_id INT NOT NULL');
        $this->addSql('ALTER TABLE header ADD CONSTRAINT FK_6E72A8C1EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E72A8C1EE45BDBF ON header (picture_id)');
        $this->addSql('ALTER TABLE event ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7C54C8C93 ON event (type_id)');
        $this->addSql('ALTER TABLE footer ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE footer ADD CONSTRAINT FK_E2310553EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2310553EE45BDBF ON footer (picture_id)');
        $this->addSql('ALTER TABLE picture ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8971F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F8971F7E88B ON picture (event_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7C54C8C93');
        $this->addSql('DROP INDEX IDX_3BAE0AA7C54C8C93 ON event');
        $this->addSql('ALTER TABLE event DROP type_id');
        $this->addSql('ALTER TABLE footer DROP FOREIGN KEY FK_E2310553EE45BDBF');
        $this->addSql('DROP INDEX UNIQ_E2310553EE45BDBF ON footer');
        $this->addSql('ALTER TABLE footer DROP picture_id');
        $this->addSql('ALTER TABLE header DROP FOREIGN KEY FK_6E72A8C1EE45BDBF');
        $this->addSql('DROP INDEX UNIQ_6E72A8C1EE45BDBF ON header');
        $this->addSql('ALTER TABLE header DROP picture_id');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8971F7E88B');
        $this->addSql('DROP INDEX IDX_16DB4F8971F7E88B ON picture');
        $this->addSql('ALTER TABLE picture DROP event_id');
    }
}
