<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125124253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE headers_picture DROP FOREIGN KEY FK_B78BDE392EF91FD8');
        $this->addSql('ALTER TABLE picture_header DROP FOREIGN KEY FK_FF961ED12EF91FD8');
        $this->addSql('CREATE TABLE parameter (id INT AUTO_INCREMENT NOT NULL, key_index VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE header');
        $this->addSql('DROP TABLE headers_picture');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE main_header');
        $this->addSql('DROP TABLE picture_header');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE types_picture');
        $this->addSql('DROP INDEX UNIQ_8CDE5729EE45BDBF ON type');
        $this->addSql('ALTER TABLE type DROP picture_id');
        $this->addSql('ALTER TABLE user DROP is_valid');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE header (id INT AUTO_INCREMENT NOT NULL, tab VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, text TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, text2 VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, text3 VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE headers_picture (id INT AUTO_INCREMENT NOT NULL, header_id INT DEFAULT NULL, path VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_B78BDE392EF91FD8 (header_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, opening VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, closing VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, open TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE main_header (id INT AUTO_INCREMENT NOT NULL, image1 VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, text_image1 LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, text_image2 LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, image3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, text_image3 LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE picture_header (picture_id INT NOT NULL, header_id INT NOT NULL, INDEX IDX_FF961ED1EE45BDBF (picture_id), INDEX IDX_FF961ED12EF91FD8 (header_id), PRIMARY KEY(picture_id, header_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE types_picture (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, path VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_CBA9F8BFC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE headers_picture ADD CONSTRAINT FK_B78BDE392EF91FD8 FOREIGN KEY (header_id) REFERENCES header (id)');
        $this->addSql('ALTER TABLE picture_header ADD CONSTRAINT FK_FF961ED12EF91FD8 FOREIGN KEY (header_id) REFERENCES header (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture_header ADD CONSTRAINT FK_FF961ED1EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE types_picture ADD CONSTRAINT FK_CBA9F8BFC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('ALTER TABLE type ADD picture_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8CDE5729EE45BDBF ON type (picture_id)');
        $this->addSql('ALTER TABLE user ADD is_valid TINYINT(1) NOT NULL');
    }
}
