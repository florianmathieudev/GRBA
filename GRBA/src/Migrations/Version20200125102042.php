<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125102042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE main_header (id INT AUTO_INCREMENT NOT NULL, image1 VARCHAR(255) NOT NULL, text_image1 LONGTEXT DEFAULT NULL, image2 VARCHAR(255) DEFAULT NULL, text_image2 LONGTEXT DEFAULT NULL, image3 VARCHAR(255) DEFAULT NULL, text_image3 LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('DROP TABLE horaire');
        // $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729EE45BDBF FOREIGN KEY (picture_id) REFERENCES types_picture (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, opening VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, closing VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, open TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE main_header');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729EE45BDBF');
    }
}
