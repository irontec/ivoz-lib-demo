<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110111309 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Create inherited tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs        
        $this->addSql('CREATE TABLE Changelog (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', entity VARCHAR(150) NOT NULL, entityId VARCHAR(36) NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', createdOn DATETIME NOT NULL, microtime SMALLINT NOT NULL, commandId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_4AB3A4A28F36C645 (commandId), INDEX changelog_createdOn (createdOn), INDEX changelog_entity_id_idx (entity, entityId), INDEX changelog_entity_createdOn (entity, createdOn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');        
        $this->addSql('CREATE TABLE Commandlog (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', requestId CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', class VARCHAR(50) NOT NULL, method VARCHAR(64) DEFAULT NULL, arguments LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', agent LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', createdOn DATETIME NOT NULL, microtime SMALLINT NOT NULL, INDEX commandlog_requestId (requestId), INDEX commandlog_createdOn (createdOn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Changelog ADD CONSTRAINT FK_4AB3A4A28F36C645 FOREIGN KEY (commandId) REFERENCES Commandlog (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Changelog DROP FOREIGN KEY FK_4AB3A4A28F36C645');        
        $this->addSql('DROP TABLE Changelog');
        $this->addSql('DROP TABLE Commandlog');
        $this->addSql('DROP TABLE refresh_tokens');
    }
}
