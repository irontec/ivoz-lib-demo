<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201161309 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add timezone FK to Administrator';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrators ADD timezoneId INT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE Administrators ADD CONSTRAINT FK_CA5E09B731D2BA8E FOREIGN KEY (timezoneId) REFERENCES Timezones (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_CA5E09B731D2BA8E ON Administrators (timezoneId)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Administrators DROP FOREIGN KEY FK_CA5E09B731D2BA8E');
        $this->addSql('DROP INDEX IDX_CA5E09B731D2BA8E ON Administrators');
        $this->addSql('ALTER TABLE Administrators DROP timezoneId');
    }
}
