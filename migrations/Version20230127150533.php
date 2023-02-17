<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127150533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, value VARCHAR(255) DEFAULT NULL, correct BOOLEAN DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE classe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organization_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8F87BF9632C8A3DE ON classe (organization_id)');
        $this->addSql('CREATE TABLE classe_user (classe_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(classe_id, user_id))');
        $this->addSql('CREATE INDEX IDX_9380A3AF8F5EA509 ON classe_user (classe_id)');
        $this->addSql('CREATE INDEX IDX_9380A3AFA76ED395 ON classe_user (user_id)');
        $this->addSql('CREATE TABLE course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, createdat DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_169E6FB9AFC2B591 ON course (module_id)');
        $this->addSql('CREATE TABLE exercice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL, createdat DATETIME NOT NULL, datelimit DATETIME DEFAULT NULL, contentbeginner CLOB DEFAULT NULL, contentintermediate CLOB DEFAULT NULL, contentexpert CLOB DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_E418C74DAFC2B591 ON exercice (module_id)');
        $this->addSql('CREATE TABLE exercice_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, exercice_id INTEGER NOT NULL, content CLOB NOT NULL, link VARCHAR(255) DEFAULT NULL, createdat DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6DB596FCA76ED395 ON exercice_work (user_id)');
        $this->addSql('CREATE INDEX IDX_6DB596FC89D40298 ON exercice_work (exercice_id)');
        $this->addSql('CREATE TABLE forum (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organization_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_852BBECD32C8A3DE ON forum (organization_id)');
        $this->addSql('CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, topic_id INTEGER NOT NULL, content CLOB NOT NULL, createdat DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_B6BD307FA76ED395 ON message (user_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F1F55203D ON message (topic_id)');
        $this->addSql('CREATE TABLE module (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, classe_id INTEGER NOT NULL, createdat DATETIME NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C242628A76ED395 ON module (user_id)');
        $this->addSql('CREATE INDEX IDX_C2426288F5EA509 ON module (classe_id)');
        $this->addSql('CREATE TABLE organization (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quiz_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL, placeholder VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_B6F7494E853CD175 ON question (quiz_id)');
        $this->addSql('CREATE TABLE quiz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id INTEGER NOT NULL, label VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A412FA92AFC2B591 ON quiz (module_id)');
        $this->addSql('CREATE TABLE quiz_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, quiz_id INTEGER NOT NULL, correctanswer INTEGER NOT NULL, createdat DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_99BF94DBA76ED395 ON quiz_work (user_id)');
        $this->addSql('CREATE INDEX IDX_99BF94DB853CD175 ON quiz_work (quiz_id)');
        $this->addSql('CREATE TABLE topic (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, forum_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, createdat DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_9D40DE1BA76ED395 ON topic (user_id)');
        $this->addSql('CREATE INDEX IDX_9D40DE1B29CCBAD0 ON topic (forum_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organization_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, profilepicture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D64932C8A3DE ON user (organization_id)');
        $this->addSql('CREATE TABLE user_avatar (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, top_type VARCHAR(255) NOT NULL, accessories_type VARCHAR(255) NOT NULL, hair_color VARCHAR(255) NOT NULL, facial_hair_type VARCHAR(255) NOT NULL, clothe_type VARCHAR(255) NOT NULL, eye_type VARCHAR(255) NOT NULL, eyebrow_type VARCHAR(255) NOT NULL, mouth_type VARCHAR(255) NOT NULL, skin_color VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_73256912A76ED395 ON user_avatar (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
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
        $this->addSql('DROP TABLE user_avatar');
    }
}
