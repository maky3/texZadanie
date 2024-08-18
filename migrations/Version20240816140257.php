<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240816140257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `brand` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `car` (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, model_id INT DEFAULT NULL, photo_path VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_773DE69D44F5D008 (brand_id), INDEX IDX_773DE69D7975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `credit_application` (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, program_id INT DEFAULT NULL, initial_payment DOUBLE PRECISION NOT NULL, loan_term INT NOT NULL, INDEX IDX_88713BF1C3C6F69F (car_id), INDEX IDX_88713BF13EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `credit_program` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, interest_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `model` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `car` ADD CONSTRAINT FK_773DE69D44F5D008 FOREIGN KEY (brand_id) REFERENCES `brand` (id)');
        $this->addSql('ALTER TABLE `car` ADD CONSTRAINT FK_773DE69D7975B7E7 FOREIGN KEY (model_id) REFERENCES `model` (id)');
        $this->addSql('ALTER TABLE `credit_application` ADD CONSTRAINT FK_88713BF1C3C6F69F FOREIGN KEY (car_id) REFERENCES `car` (id)');
        $this->addSql('ALTER TABLE `credit_application` ADD CONSTRAINT FK_88713BF13EB8070A FOREIGN KEY (program_id) REFERENCES `credit_program` (id)');
        $this->addSql('ALTER TABLE coupon DROP FOREIGN KEY FK_64BF3F024584665A');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, code VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, discount_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, discount_value DOUBLE PRECISION NOT NULL, tax_number VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, INDEX IDX_64BF3F024584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE coupon ADD CONSTRAINT FK_64BF3F024584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE `car` DROP FOREIGN KEY FK_773DE69D44F5D008');
        $this->addSql('ALTER TABLE `car` DROP FOREIGN KEY FK_773DE69D7975B7E7');
        $this->addSql('ALTER TABLE `credit_application` DROP FOREIGN KEY FK_88713BF1C3C6F69F');
        $this->addSql('ALTER TABLE `credit_application` DROP FOREIGN KEY FK_88713BF13EB8070A');
        $this->addSql('DROP TABLE `brand`');
        $this->addSql('DROP TABLE `car`');
        $this->addSql('DROP TABLE `credit_application`');
        $this->addSql('DROP TABLE `credit_program`');
        $this->addSql('DROP TABLE `model`');
    }
}
