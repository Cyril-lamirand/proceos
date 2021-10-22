<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211022132814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, value VARCHAR(255) NOT NULL, correct TINYINT(1) NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, organization_id INT NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_8F87BF9632C8A3DE (organization_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_user (classe_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9380A3AF8F5EA509 (classe_id), INDEX IDX_9380A3AFA76ED395 (user_id), PRIMARY KEY(classe_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, createdat DATETIME NOT NULL, INDEX IDX_169E6FB9AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, createdat DATETIME NOT NULL, datelimit DATETIME DEFAULT NULL, contentbeginner LONGTEXT DEFAULT NULL, contentintermediate LONGTEXT DEFAULT NULL, contentexpert LONGTEXT DEFAULT NULL, INDEX IDX_E418C74DAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice_work (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, exercice_id INT NOT NULL, content LONGTEXT NOT NULL, link VARCHAR(255) DEFAULT NULL, createdat DATETIME NOT NULL, INDEX IDX_6DB596FCA76ED395 (user_id), INDEX IDX_6DB596FC89D40298 (exercice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum (id INT AUTO_INCREMENT NOT NULL, organization_id INT NOT NULL, label VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_852BBECD32C8A3DE (organization_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, content LONGTEXT NOT NULL, createdat DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, classe_id INT NOT NULL, createdat DATETIME NOT NULL, INDEX IDX_C242628A76ED395 (user_id), INDEX IDX_C2426288F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, placeholder VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, label VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, UNIQUE INDEX UNIQ_A412FA92AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz_work (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, quiz_id INT NOT NULL, correctanswer INT NOT NULL, createdat DATETIME NOT NULL, INDEX IDX_99BF94DBA76ED395 (user_id), INDEX IDX_99BF94DB853CD175 (quiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL, INDEX IDX_9D40DE1BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, organization_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64932C8A3DE (organization_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9632C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id)');
        $this->addSql('ALTER TABLE classe_user ADD CONSTRAINT FK_9380A3AF8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_user ADD CONSTRAINT FK_9380A3AFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE exercice_work ADD CONSTRAINT FK_6DB596FCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE exercice_work ADD CONSTRAINT FK_6DB596FC89D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECD32C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426288F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE quiz_work ADD CONSTRAINT FK_99BF94DBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quiz_work ADD CONSTRAINT FK_99BF94DB853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id)');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64932C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_user DROP FOREIGN KEY FK_9380A3AF8F5EA509');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426288F5EA509');
        $this->addSql('ALTER TABLE exercice_work DROP FOREIGN KEY FK_6DB596FC89D40298');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9AFC2B591');
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DAFC2B591');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92AFC2B591');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9632C8A3DE');
        $this->addSql('ALTER TABLE forum DROP FOREIGN KEY FK_852BBECD32C8A3DE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64932C8A3DE');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E853CD175');
        $this->addSql('ALTER TABLE quiz_work DROP FOREIGN KEY FK_99BF94DB853CD175');
        $this->addSql('ALTER TABLE classe_user DROP FOREIGN KEY FK_9380A3AFA76ED395');
        $this->addSql('ALTER TABLE exercice_work DROP FOREIGN KEY FK_6DB596FCA76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628A76ED395');
        $this->addSql('ALTER TABLE quiz_work DROP FOREIGN KEY FK_99BF94DBA76ED395');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1BA76ED395');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_user');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE exercice_work');
        $this->addSql('DROP TABLE forum');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE organization');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_work');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE user');
    }
}
