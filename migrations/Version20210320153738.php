<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210320153738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deposit (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, deposit_location_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_95DB9D39A76ED395 (user_id), INDEX IDX_95DB9D39E4005079 (deposit_location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deposit_content (id INT AUTO_INCREMENT NOT NULL, mask_type_id INT NOT NULL, deposit_id INT NOT NULL, quantity SMALLINT NOT NULL, INDEX IDX_FF0FCAF24B1C7114 (mask_type_id), INDEX IDX_FF0FCAF29815E4B1 (deposit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deposit_location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, address1 VARCHAR(255) DEFAULT NULL, address2 VARCHAR(255) DEFAULT NULL, zipcode INT DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_31E581A0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mask_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_deposit_location (partner_id INT NOT NULL, deposit_location_id INT NOT NULL, INDEX IDX_AF01E669393F8FE (partner_id), INDEX IDX_AF01E66E4005079 (deposit_location_id), PRIMARY KEY(partner_id, deposit_location_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D39A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D39E4005079 FOREIGN KEY (deposit_location_id) REFERENCES deposit_location (id)');
        $this->addSql('ALTER TABLE deposit_content ADD CONSTRAINT FK_FF0FCAF24B1C7114 FOREIGN KEY (mask_type_id) REFERENCES mask_type (id)');
        $this->addSql('ALTER TABLE deposit_content ADD CONSTRAINT FK_FF0FCAF29815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id)');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partner_deposit_location ADD CONSTRAINT FK_AF01E669393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partner_deposit_location ADD CONSTRAINT FK_AF01E66E4005079 FOREIGN KEY (deposit_location_id) REFERENCES deposit_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD address1 VARCHAR(255) DEFAULT NULL, ADD address2 VARCHAR(255) DEFAULT NULL, ADD zipcode SMALLINT DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD birth_date DATE DEFAULT NULL, ADD company_name VARCHAR(255) DEFAULT NULL, ADD siret_number INT DEFAULT NULL, ADD is_company TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit_content DROP FOREIGN KEY FK_FF0FCAF29815E4B1');
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D39E4005079');
        $this->addSql('ALTER TABLE partner_deposit_location DROP FOREIGN KEY FK_AF01E66E4005079');
        $this->addSql('ALTER TABLE deposit_content DROP FOREIGN KEY FK_FF0FCAF24B1C7114');
        $this->addSql('ALTER TABLE partner_deposit_location DROP FOREIGN KEY FK_AF01E669393F8FE');
        $this->addSql('DROP TABLE deposit');
        $this->addSql('DROP TABLE deposit_content');
        $this->addSql('DROP TABLE deposit_location');
        $this->addSql('DROP TABLE donation');
        $this->addSql('DROP TABLE mask_type');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE partner_deposit_location');
        $this->addSql('ALTER TABLE user DROP first_name, DROP last_name, DROP address1, DROP address2, DROP zipcode, DROP city, DROP birth_date, DROP company_name, DROP siret_number, DROP is_company');
    }
}
