<?php

declare(strict_types=1);

namespace Demo\Domain\Model\Client;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

/**
* ClientAbstract
* @codeCoverageIgnore
*/
abstract class ClientAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $iden;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var int
     */
    protected $desktopLicenses;

    /**
     * @var int
     */
    protected $provisioningTemplateId;

    /**
     * @var int
     */
    protected $platformId;

    /**
     * @var ?int
     */
    protected $remoteId = null;

    /**
     * @var int
     */
    protected $emailTemplateId;

    /**
     * @var int
     */
    protected $mobileLicences;

    /**
     * @var string
     * comment: enum:password|ldap|azureAd
     */
    protected $authType = 'password';

    /**
     * @var ?string
     */
    protected $ldapServer = null;

    /**
     * @var ?string
     */
    protected $ldapQuery = null;

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * @var ?string
     */
    protected $proxyHost = null;

    /**
     * @var ?int
     */
    protected $proxyPort = null;

    /**
     * @var string
     * comment: enum:required|disabled
     */
    protected $sdes = 'required';

    /**
     * @var string
     * comment: enum:udp|tcp|tls+sip:
     */
    protected $transport = 'tls+sip:';

    /**
     * @var int
     */
    protected $cardDav;

    /**
     * @var ?string
     */
    protected $cardDavPass = null;

    /**
     * @var string
     */
    protected $customTabUrl;

    /**
     * @var string
     */
    protected $voiceMailNumber = '*93';

    /**
     * @var string
     */
    protected $customTabTitle;

    /**
     * @var int
     */
    protected $dualLicences;

    /**
     * @var int
     */
    protected $displayDnd = 1;

    /**
     * @var \DateTimeInterface
     */
    protected $activationDate;

    /**
     * @var string
     */
    protected $intRef = '';

    /**
     * @var string
     */
    protected $intRefUrl = '';

    /**
     * @var ?\DateTime
     */
    protected $lastSuccessfulSync = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $iden,
        string $domain,
        int $desktopLicenses,
        int $provisioningTemplateId,
        int $platformId,
        int $emailTemplateId,
        int $mobileLicences,
        string $authType,
        string $sdes,
        string $transport,
        int $cardDav,
        string $customTabUrl,
        string $voiceMailNumber,
        string $customTabTitle,
        int $dualLicences,
        int $displayDnd,
        \DateTimeInterface $activationDate,
        string $intRef,
        string $intRefUrl
    ) {
        $this->setIden($iden);
        $this->setDomain($domain);
        $this->setDesktopLicenses($desktopLicenses);
        $this->setProvisioningTemplateId($provisioningTemplateId);
        $this->setPlatformId($platformId);
        $this->setEmailTemplateId($emailTemplateId);
        $this->setMobileLicences($mobileLicences);
        $this->setAuthType($authType);
        $this->setSdes($sdes);
        $this->setTransport($transport);
        $this->setCardDav($cardDav);
        $this->setCustomTabUrl($customTabUrl);
        $this->setVoiceMailNumber($voiceMailNumber);
        $this->setCustomTabTitle($customTabTitle);
        $this->setDualLicences($dualLicences);
        $this->setDisplayDnd($displayDnd);
        $this->setActivationDate($activationDate);
        $this->setIntRef($intRef);
        $this->setIntRefUrl($intRefUrl);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Client",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ClientDto
    {
        return new ClientDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ClientInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ClientDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ClientInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ClientDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ClientDto::class);
        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');
        $domain = $dto->getDomain();
        Assertion::notNull($domain, 'getDomain value is null, but non null value was expected.');
        $desktopLicenses = $dto->getDesktopLicenses();
        Assertion::notNull($desktopLicenses, 'getDesktopLicenses value is null, but non null value was expected.');
        $provisioningTemplateId = $dto->getProvisioningTemplateId();
        Assertion::notNull($provisioningTemplateId, 'getProvisioningTemplateId value is null, but non null value was expected.');
        $platformId = $dto->getPlatformId();
        Assertion::notNull($platformId, 'getPlatformId value is null, but non null value was expected.');
        $emailTemplateId = $dto->getEmailTemplateId();
        Assertion::notNull($emailTemplateId, 'getEmailTemplateId value is null, but non null value was expected.');
        $mobileLicences = $dto->getMobileLicences();
        Assertion::notNull($mobileLicences, 'getMobileLicences value is null, but non null value was expected.');
        $authType = $dto->getAuthType();
        Assertion::notNull($authType, 'getAuthType value is null, but non null value was expected.');
        $sdes = $dto->getSdes();
        Assertion::notNull($sdes, 'getSdes value is null, but non null value was expected.');
        $transport = $dto->getTransport();
        Assertion::notNull($transport, 'getTransport value is null, but non null value was expected.');
        $cardDav = $dto->getCardDav();
        Assertion::notNull($cardDav, 'getCardDav value is null, but non null value was expected.');
        $customTabUrl = $dto->getCustomTabUrl();
        Assertion::notNull($customTabUrl, 'getCustomTabUrl value is null, but non null value was expected.');
        $voiceMailNumber = $dto->getVoiceMailNumber();
        Assertion::notNull($voiceMailNumber, 'getVoiceMailNumber value is null, but non null value was expected.');
        $customTabTitle = $dto->getCustomTabTitle();
        Assertion::notNull($customTabTitle, 'getCustomTabTitle value is null, but non null value was expected.');
        $dualLicences = $dto->getDualLicences();
        Assertion::notNull($dualLicences, 'getDualLicences value is null, but non null value was expected.');
        $displayDnd = $dto->getDisplayDnd();
        Assertion::notNull($displayDnd, 'getDisplayDnd value is null, but non null value was expected.');
        $activationDate = $dto->getActivationDate();
        Assertion::notNull($activationDate, 'getActivationDate value is null, but non null value was expected.');
        $intRef = $dto->getIntRef();
        Assertion::notNull($intRef, 'getIntRef value is null, but non null value was expected.');
        $intRefUrl = $dto->getIntRefUrl();
        Assertion::notNull($intRefUrl, 'getIntRefUrl value is null, but non null value was expected.');

        $self = new static(
            $iden,
            $domain,
            $desktopLicenses,
            $provisioningTemplateId,
            $platformId,
            $emailTemplateId,
            $mobileLicences,
            $authType,
            $sdes,
            $transport,
            $cardDav,
            $customTabUrl,
            $voiceMailNumber,
            $customTabTitle,
            $dualLicences,
            $displayDnd,
            $activationDate,
            $intRef,
            $intRefUrl
        );

        $self
            ->setRemoteId($dto->getRemoteId())
            ->setLdapServer($dto->getLdapServer())
            ->setLdapQuery($dto->getLdapQuery())
            ->setDescription($dto->getDescription())
            ->setProxyHost($dto->getProxyHost())
            ->setProxyPort($dto->getProxyPort())
            ->setCardDavPass($dto->getCardDavPass())
            ->setLastSuccessfulSync($dto->getLastSuccessfulSync());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ClientDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ClientDto::class);

        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');
        $domain = $dto->getDomain();
        Assertion::notNull($domain, 'getDomain value is null, but non null value was expected.');
        $desktopLicenses = $dto->getDesktopLicenses();
        Assertion::notNull($desktopLicenses, 'getDesktopLicenses value is null, but non null value was expected.');
        $provisioningTemplateId = $dto->getProvisioningTemplateId();
        Assertion::notNull($provisioningTemplateId, 'getProvisioningTemplateId value is null, but non null value was expected.');
        $platformId = $dto->getPlatformId();
        Assertion::notNull($platformId, 'getPlatformId value is null, but non null value was expected.');
        $emailTemplateId = $dto->getEmailTemplateId();
        Assertion::notNull($emailTemplateId, 'getEmailTemplateId value is null, but non null value was expected.');
        $mobileLicences = $dto->getMobileLicences();
        Assertion::notNull($mobileLicences, 'getMobileLicences value is null, but non null value was expected.');
        $authType = $dto->getAuthType();
        Assertion::notNull($authType, 'getAuthType value is null, but non null value was expected.');
        $sdes = $dto->getSdes();
        Assertion::notNull($sdes, 'getSdes value is null, but non null value was expected.');
        $transport = $dto->getTransport();
        Assertion::notNull($transport, 'getTransport value is null, but non null value was expected.');
        $cardDav = $dto->getCardDav();
        Assertion::notNull($cardDav, 'getCardDav value is null, but non null value was expected.');
        $customTabUrl = $dto->getCustomTabUrl();
        Assertion::notNull($customTabUrl, 'getCustomTabUrl value is null, but non null value was expected.');
        $voiceMailNumber = $dto->getVoiceMailNumber();
        Assertion::notNull($voiceMailNumber, 'getVoiceMailNumber value is null, but non null value was expected.');
        $customTabTitle = $dto->getCustomTabTitle();
        Assertion::notNull($customTabTitle, 'getCustomTabTitle value is null, but non null value was expected.');
        $dualLicences = $dto->getDualLicences();
        Assertion::notNull($dualLicences, 'getDualLicences value is null, but non null value was expected.');
        $displayDnd = $dto->getDisplayDnd();
        Assertion::notNull($displayDnd, 'getDisplayDnd value is null, but non null value was expected.');
        $activationDate = $dto->getActivationDate();
        Assertion::notNull($activationDate, 'getActivationDate value is null, but non null value was expected.');
        $intRef = $dto->getIntRef();
        Assertion::notNull($intRef, 'getIntRef value is null, but non null value was expected.');
        $intRefUrl = $dto->getIntRefUrl();
        Assertion::notNull($intRefUrl, 'getIntRefUrl value is null, but non null value was expected.');

        $this
            ->setIden($iden)
            ->setDomain($domain)
            ->setDesktopLicenses($desktopLicenses)
            ->setProvisioningTemplateId($provisioningTemplateId)
            ->setPlatformId($platformId)
            ->setRemoteId($dto->getRemoteId())
            ->setEmailTemplateId($emailTemplateId)
            ->setMobileLicences($mobileLicences)
            ->setAuthType($authType)
            ->setLdapServer($dto->getLdapServer())
            ->setLdapQuery($dto->getLdapQuery())
            ->setDescription($dto->getDescription())
            ->setProxyHost($dto->getProxyHost())
            ->setProxyPort($dto->getProxyPort())
            ->setSdes($sdes)
            ->setTransport($transport)
            ->setCardDav($cardDav)
            ->setCardDavPass($dto->getCardDavPass())
            ->setCustomTabUrl($customTabUrl)
            ->setVoiceMailNumber($voiceMailNumber)
            ->setCustomTabTitle($customTabTitle)
            ->setDualLicences($dualLicences)
            ->setDisplayDnd($displayDnd)
            ->setActivationDate($activationDate)
            ->setIntRef($intRef)
            ->setIntRefUrl($intRefUrl)
            ->setLastSuccessfulSync($dto->getLastSuccessfulSync());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ClientDto
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setDomain(self::getDomain())
            ->setDesktopLicenses(self::getDesktopLicenses())
            ->setProvisioningTemplateId(self::getProvisioningTemplateId())
            ->setPlatformId(self::getPlatformId())
            ->setRemoteId(self::getRemoteId())
            ->setEmailTemplateId(self::getEmailTemplateId())
            ->setMobileLicences(self::getMobileLicences())
            ->setAuthType(self::getAuthType())
            ->setLdapServer(self::getLdapServer())
            ->setLdapQuery(self::getLdapQuery())
            ->setDescription(self::getDescription())
            ->setProxyHost(self::getProxyHost())
            ->setProxyPort(self::getProxyPort())
            ->setSdes(self::getSdes())
            ->setTransport(self::getTransport())
            ->setCardDav(self::getCardDav())
            ->setCardDavPass(self::getCardDavPass())
            ->setCustomTabUrl(self::getCustomTabUrl())
            ->setVoiceMailNumber(self::getVoiceMailNumber())
            ->setCustomTabTitle(self::getCustomTabTitle())
            ->setDualLicences(self::getDualLicences())
            ->setDisplayDnd(self::getDisplayDnd())
            ->setActivationDate(self::getActivationDate())
            ->setIntRef(self::getIntRef())
            ->setIntRefUrl(self::getIntRefUrl())
            ->setLastSuccessfulSync(self::getLastSuccessfulSync());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'iden' => self::getIden(),
            'domain' => self::getDomain(),
            'desktopLicenses' => self::getDesktopLicenses(),
            'provisioningTemplateId' => self::getProvisioningTemplateId(),
            'platformId' => self::getPlatformId(),
            'remoteId' => self::getRemoteId(),
            'emailTemplateId' => self::getEmailTemplateId(),
            'mobileLicences' => self::getMobileLicences(),
            'authType' => self::getAuthType(),
            'ldapServer' => self::getLdapServer(),
            'ldapQuery' => self::getLdapQuery(),
            'description' => self::getDescription(),
            'proxyHost' => self::getProxyHost(),
            'proxyPort' => self::getProxyPort(),
            'sdes' => self::getSdes(),
            'transport' => self::getTransport(),
            'cardDav' => self::getCardDav(),
            'cardDavPass' => self::getCardDavPass(),
            'customTabUrl' => self::getCustomTabUrl(),
            'voiceMailNumber' => self::getVoiceMailNumber(),
            'customTabTitle' => self::getCustomTabTitle(),
            'dualLicences' => self::getDualLicences(),
            'displayDnd' => self::getDisplayDnd(),
            'activationDate' => self::getActivationDate(),
            'intRef' => self::getIntRef(),
            'intRefUrl' => self::getIntRefUrl(),
            'lastSuccessfulSync' => self::getLastSuccessfulSync()
        ];
    }

    protected function setIden(string $iden): static
    {
        Assertion::maxLength($iden, 64, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    public function getIden(): string
    {
        return $this->iden;
    }

    protected function setDomain(string $domain): static
    {
        Assertion::maxLength($domain, 255, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    protected function setDesktopLicenses(int $desktopLicenses): static
    {
        $this->desktopLicenses = $desktopLicenses;

        return $this;
    }

    public function getDesktopLicenses(): int
    {
        return $this->desktopLicenses;
    }

    protected function setProvisioningTemplateId(int $provisioningTemplateId): static
    {
        $this->provisioningTemplateId = $provisioningTemplateId;

        return $this;
    }

    public function getProvisioningTemplateId(): int
    {
        return $this->provisioningTemplateId;
    }

    protected function setPlatformId(int $platformId): static
    {
        $this->platformId = $platformId;

        return $this;
    }

    public function getPlatformId(): int
    {
        return $this->platformId;
    }

    protected function setRemoteId(?int $remoteId = null): static
    {
        $this->remoteId = $remoteId;

        return $this;
    }

    public function getRemoteId(): ?int
    {
        return $this->remoteId;
    }

    protected function setEmailTemplateId(int $emailTemplateId): static
    {
        $this->emailTemplateId = $emailTemplateId;

        return $this;
    }

    public function getEmailTemplateId(): int
    {
        return $this->emailTemplateId;
    }

    protected function setMobileLicences(int $mobileLicences): static
    {
        $this->mobileLicences = $mobileLicences;

        return $this;
    }

    public function getMobileLicences(): int
    {
        return $this->mobileLicences;
    }

    protected function setAuthType(string $authType): static
    {
        Assertion::maxLength($authType, 64, 'authType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $authType,
            [
                ClientInterface::AUTHTYPE_PASSWORD,
                ClientInterface::AUTHTYPE_LDAP,
                ClientInterface::AUTHTYPE_AZUREAD,
            ],
            'authTypevalue "%s" is not an element of the valid values: %s'
        );

        $this->authType = $authType;

        return $this;
    }

    public function getAuthType(): string
    {
        return $this->authType;
    }

    protected function setLdapServer(?string $ldapServer = null): static
    {
        if (!is_null($ldapServer)) {
            Assertion::maxLength($ldapServer, 128, 'ldapServer value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ldapServer = $ldapServer;

        return $this;
    }

    public function getLdapServer(): ?string
    {
        return $this->ldapServer;
    }

    protected function setLdapQuery(?string $ldapQuery = null): static
    {
        if (!is_null($ldapQuery)) {
            Assertion::maxLength($ldapQuery, 256, 'ldapQuery value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ldapQuery = $ldapQuery;

        return $this;
    }

    public function getLdapQuery(): ?string
    {
        return $this->ldapQuery;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 255, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function setProxyHost(?string $proxyHost = null): static
    {
        if (!is_null($proxyHost)) {
            Assertion::maxLength($proxyHost, 255, 'proxyHost value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->proxyHost = $proxyHost;

        return $this;
    }

    public function getProxyHost(): ?string
    {
        return $this->proxyHost;
    }

    protected function setProxyPort(?int $proxyPort = null): static
    {
        $this->proxyPort = $proxyPort;

        return $this;
    }

    public function getProxyPort(): ?int
    {
        return $this->proxyPort;
    }

    protected function setSdes(string $sdes): static
    {
        Assertion::maxLength($sdes, 64, 'sdes value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $sdes,
            [
                ClientInterface::SDES_REQUIRED,
                ClientInterface::SDES_DISABLED,
            ],
            'sdesvalue "%s" is not an element of the valid values: %s'
        );

        $this->sdes = $sdes;

        return $this;
    }

    public function getSdes(): string
    {
        return $this->sdes;
    }

    protected function setTransport(string $transport): static
    {
        Assertion::maxLength($transport, 64, 'transport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $transport,
            [
                ClientInterface::TRANSPORT_UDP,
                ClientInterface::TRANSPORT_TCP,
                ClientInterface::TRANSPORT_TLSSIP,
            ],
            'transportvalue "%s" is not an element of the valid values: %s'
        );

        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): string
    {
        return $this->transport;
    }

    protected function setCardDav(int $cardDav): static
    {
        $this->cardDav = $cardDav;

        return $this;
    }

    public function getCardDav(): int
    {
        return $this->cardDav;
    }

    protected function setCardDavPass(?string $cardDavPass = null): static
    {
        if (!is_null($cardDavPass)) {
            Assertion::maxLength($cardDavPass, 255, 'cardDavPass value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->cardDavPass = $cardDavPass;

        return $this;
    }

    public function getCardDavPass(): ?string
    {
        return $this->cardDavPass;
    }

    protected function setCustomTabUrl(string $customTabUrl): static
    {
        Assertion::maxLength($customTabUrl, 512, 'customTabUrl value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->customTabUrl = $customTabUrl;

        return $this;
    }

    public function getCustomTabUrl(): string
    {
        return $this->customTabUrl;
    }

    protected function setVoiceMailNumber(string $voiceMailNumber): static
    {
        Assertion::maxLength($voiceMailNumber, 8, 'voiceMailNumber value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->voiceMailNumber = $voiceMailNumber;

        return $this;
    }

    public function getVoiceMailNumber(): string
    {
        return $this->voiceMailNumber;
    }

    protected function setCustomTabTitle(string $customTabTitle): static
    {
        Assertion::maxLength($customTabTitle, 32, 'customTabTitle value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->customTabTitle = $customTabTitle;

        return $this;
    }

    public function getCustomTabTitle(): string
    {
        return $this->customTabTitle;
    }

    protected function setDualLicences(int $dualLicences): static
    {
        $this->dualLicences = $dualLicences;

        return $this;
    }

    public function getDualLicences(): int
    {
        return $this->dualLicences;
    }

    protected function setDisplayDnd(int $displayDnd): static
    {
        $this->displayDnd = $displayDnd;

        return $this;
    }

    public function getDisplayDnd(): int
    {
        return $this->displayDnd;
    }

    protected function setActivationDate(string|\DateTimeInterface $activationDate): static
    {

        /** @var \DateTime */
        $activationDate = !($activationDate instanceof \DateTimeInterface)
            ? \DateTime::createFromFormat($activationDate, 'Y-m-d', new \DateTimeZone('UTC'))
            : $activationDate;

        if ($this->isInitialized() && $this->activationDate == $activationDate) {
            return $this;
        }

        $this->activationDate = $activationDate;

        return $this;
    }

    public function getActivationDate(): \DateTimeInterface
    {
        return $this->activationDate;
    }

    protected function setIntRef(string $intRef): static
    {
        Assertion::maxLength($intRef, 16, 'intRef value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->intRef = $intRef;

        return $this;
    }

    public function getIntRef(): string
    {
        return $this->intRef;
    }

    protected function setIntRefUrl(string $intRefUrl): static
    {
        Assertion::maxLength($intRefUrl, 512, 'intRefUrl value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->intRefUrl = $intRefUrl;

        return $this;
    }

    public function getIntRefUrl(): string
    {
        return $this->intRefUrl;
    }

    protected function setLastSuccessfulSync(string|\DateTimeInterface|null $lastSuccessfulSync = null): static
    {
        if (!is_null($lastSuccessfulSync)) {

            /** @var ?\DateTime */
            $lastSuccessfulSync = DateTimeHelper::createOrFix(
                $lastSuccessfulSync,
                null
            );

            if ($this->isInitialized() && $this->lastSuccessfulSync == $lastSuccessfulSync) {
                return $this;
            }
        }

        $this->lastSuccessfulSync = $lastSuccessfulSync;

        return $this;
    }

    public function getLastSuccessfulSync(): ?\DateTime
    {
        return !is_null($this->lastSuccessfulSync) ? clone $this->lastSuccessfulSync : null;
    }
}
