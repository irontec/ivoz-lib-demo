<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\LoggableMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240111084502 extends LoggableMigration
{
    public function getDescription(): string
    {
        return 'Create tables for Platforms and Clients';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Clients (id INT UNSIGNED AUTO_INCREMENT NOT NULL, iden VARCHAR(64) NOT NULL, domain VARCHAR(255) NOT NULL, desktopLicenses INT NOT NULL, provisioningTemplateId INT NOT NULL, platformId INT NOT NULL, remoteId INT DEFAULT NULL, emailTemplateId INT NOT NULL, mobileLicences INT NOT NULL, authType VARCHAR(64) DEFAULT \'password\' NOT NULL COMMENT \'[enum:password|ldap|azureAd]\', ldapServer VARCHAR(128) DEFAULT NULL, ldapQuery VARCHAR(256) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, proxyHost VARCHAR(255) DEFAULT NULL, proxyPort INT DEFAULT NULL, sdes VARCHAR(64) DEFAULT \'required\' NOT NULL COMMENT \'[enum:required|disabled]\', transport VARCHAR(64) DEFAULT \'tls+sip:\' NOT NULL COMMENT \'[enum:udp|tcp|tls+sip:]\', cardDav SMALLINT NOT NULL, cardDavPass VARCHAR(255) DEFAULT NULL, customTabUrl VARCHAR(512) NOT NULL, voiceMailNumber VARCHAR(8) DEFAULT \'*93\' NOT NULL, customTabTitle VARCHAR(32) NOT NULL, dualLicences INT NOT NULL, displayDnd SMALLINT DEFAULT 1 NOT NULL, activationDate DATE NOT NULL, intRef VARCHAR(16) DEFAULT \'\'\'\'\'\' NOT NULL, intRefUrl VARCHAR(512) DEFAULT \'\'\'\'\'\' NOT NULL, lastSuccessfulSync DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Platforms (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, apiUrl VARCHAR(255) DEFAULT NULL, refresh_token VARCHAR(255) DEFAULT \'NULL\', tlsPort INT UNSIGNED NOT NULL, type VARCHAR(50) DEFAULT \'isbc\' NOT NULL COMMENT \'[enum:isbc|other|ivozprovider-v2|ivozprovider-v3]\', tcpPort INT UNSIGNED DEFAULT 5060 NOT NULL, udpPort INT UNSIGNED DEFAULT 5060 NOT NULL, wssPort INT UNSIGNED DEFAULT 10081 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Clients');
        $this->addSql('DROP TABLE Platforms');
    }
}
