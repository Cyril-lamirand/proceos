<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505093217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE student_level (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, module_id INT NOT NULL, level VARCHAR(255) NOT NULL, INDEX IDX_12DDB58EA76ED395 (user_id), INDEX IDX_12DDB58EAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student_level ADD CONSTRAINT FK_12DDB58EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE student_level ADD CONSTRAINT FK_12DDB58EAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student_level DROP FOREIGN KEY FK_12DDB58EA76ED395');
        $this->addSql('ALTER TABLE student_level DROP FOREIGN KEY FK_12DDB58EAFC2B591');
        $this->addSql('DROP TABLE student_level');
    }
}
