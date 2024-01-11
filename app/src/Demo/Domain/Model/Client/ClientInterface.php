<?php

namespace Demo\Domain\Model\Client;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* ClientInterface
*/
interface ClientInterface extends EntityInterface
{
    public const AUTHTYPE_PASSWORD = 'password';

    public const AUTHTYPE_LDAP = 'ldap';

    public const AUTHTYPE_AZUREAD = 'azureAd';

    public const SDES_REQUIRED = 'required';

    public const SDES_DISABLED = 'disabled';

    public const TRANSPORT_UDP = 'udp';

    public const TRANSPORT_TCP = 'tcp';

    public const TRANSPORT_TLSSIP = 'tls+sip:';

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): null|int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ClientDto;

    /**
     * @internal use EntityTools instead
     * @param null|ClientInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ClientDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ClientDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ClientDto;

    public function getIden(): string;

    public function getDomain(): string;

    public function getDesktopLicenses(): int;

    public function getProvisioningTemplateId(): int;

    public function getPlatformId(): int;

    public function getRemoteId(): ?int;

    public function getEmailTemplateId(): int;

    public function getMobileLicences(): int;

    public function getAuthType(): string;

    public function getLdapServer(): ?string;

    public function getLdapQuery(): ?string;

    public function getDescription(): ?string;

    public function getProxyHost(): ?string;

    public function getProxyPort(): ?int;

    public function getSdes(): string;

    public function getTransport(): string;

    public function getCardDav(): int;

    public function getCardDavPass(): ?string;

    public function getCustomTabUrl(): string;

    public function getVoiceMailNumber(): string;

    public function getCustomTabTitle(): string;

    public function getDualLicences(): int;

    public function getDisplayDnd(): int;

    public function getActivationDate(): \DateTimeInterface;

    public function getIntRef(): string;

    public function getIntRefUrl(): string;

    public function getLastSuccessfulSync(): ?\DateTime;
}
