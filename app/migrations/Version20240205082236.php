<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205082236 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add active field to Administrator';
    }

    public function preUp(Schema $schema): void
    {
        $this->addSql('UPDATE Administrators SET email = "noreplay@irontec.com" WHERE id = 1 AND email IS NULL');
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Administrators ADD active SMALLINT DEFAULT 0 NOT NULL, CHANGE email email VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE Administrators DROP active, CHANGE email email VARCHAR(100) DEFAULT NULL');
    }
}
