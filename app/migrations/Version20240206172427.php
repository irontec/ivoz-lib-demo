<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240206172427 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Add Services table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Services (id INT UNSIGNED AUTO_INCREMENT NOT NULL, iden VARCHAR(50) NOT NULL, UNIQUE INDEX services_iden (iden), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->populateFactoryServices();
    }

    private function populateFactoryServices()
    {
        $factoryServices = [
            'Recording', 'Voicemail', 'Queues'
        ];

        foreach ($factoryServices as $srv) {
            $this->addSql('INSERT INTO Services(iden) VALUES(:srv)', ['srv' => $srv]);
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Services');
    }
}
