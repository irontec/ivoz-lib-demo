<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130165814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add table timezone';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Timezones (id INT UNSIGNED AUTO_INCREMENT NOT NULL, tz VARCHAR(255) NOT NULL, comment VARCHAR(150) DEFAULT \'\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->populateTimezones();
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Timezones');
    }

    private function populateTimezones(): void
    {
        $timezones = \DateTimeZone::listIdentifiers();

        foreach ($timezones as $tz) {
            $this->addSql('INSERT INTO Timezones (`tz`) VALUES(:tz)', ['tz' => $tz]);
        }
    }
}
