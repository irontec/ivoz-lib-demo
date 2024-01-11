<?php

namespace Demo\Domain\Model\Client;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;

/**
* ClientDtoAbstract
* @codeCoverageIgnore
*/
abstract class ClientDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $iden = null;

    /**
     * @var string|null
     */
    private $domain = null;

    /**
     * @var int|null
     */
    private $desktopLicenses = null;

    /**
     * @var int|null
     */
    private $provisioningTemplateId = null;

    /**
     * @var int|null
     */
    private $platformId = null;

    /**
     * @var int|null
     */
    private $remoteId = null;

    /**
     * @var int|null
     */
    private $emailTemplateId = null;

    /**
     * @var int|null
     */
    private $mobileLicences = null;

    /**
     * @var string|null
     */
    private $authType = 'password';

    /**
     * @var string|null
     */
    private $ldapServer = null;

    /**
     * @var string|null
     */
    private $ldapQuery = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var string|null
     */
    private $proxyHost = null;

    /**
     * @var int|null
     */
    private $proxyPort = null;

    /**
     * @var string|null
     */
    private $sdes = 'required';

    /**
     * @var string|null
     */
    private $transport = 'tls+sip:';

    /**
     * @var int|null
     */
    private $cardDav = null;

    /**
     * @var string|null
     */
    private $cardDavPass = null;

    /**
     * @var string|null
     */
    private $customTabUrl = null;

    /**
     * @var string|null
     */
    private $voiceMailNumber = '*93';

    /**
     * @var string|null
     */
    private $customTabTitle = null;

    /**
     * @var int|null
     */
    private $dualLicences = null;

    /**
     * @var int|null
     */
    private $displayDnd = 1;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $activationDate = null;

    /**
     * @var string|null
     */
    private $intRef = '';

    /**
     * @var string|null
     */
    private $intRefUrl = '';

    /**
     * @var \DateTimeInterface|string|null
     */
    private $lastSuccessfulSync = null;

    /**
     * @var int|null
     */
    private $id = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'iden' => 'iden',
            'domain' => 'domain',
            'desktopLicenses' => 'desktopLicenses',
            'provisioningTemplateId' => 'provisioningTemplateId',
            'platformId' => 'platformId',
            'remoteId' => 'remoteId',
            'emailTemplateId' => 'emailTemplateId',
            'mobileLicences' => 'mobileLicences',
            'authType' => 'authType',
            'ldapServer' => 'ldapServer',
            'ldapQuery' => 'ldapQuery',
            'description' => 'description',
            'proxyHost' => 'proxyHost',
            'proxyPort' => 'proxyPort',
            'sdes' => 'sdes',
            'transport' => 'transport',
            'cardDav' => 'cardDav',
            'cardDavPass' => 'cardDavPass',
            'customTabUrl' => 'customTabUrl',
            'voiceMailNumber' => 'voiceMailNumber',
            'customTabTitle' => 'customTabTitle',
            'dualLicences' => 'dualLicences',
            'displayDnd' => 'displayDnd',
            'activationDate' => 'activationDate',
            'intRef' => 'intRef',
            'intRefUrl' => 'intRefUrl',
            'lastSuccessfulSync' => 'lastSuccessfulSync',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'iden' => $this->getIden(),
            'domain' => $this->getDomain(),
            'desktopLicenses' => $this->getDesktopLicenses(),
            'provisioningTemplateId' => $this->getProvisioningTemplateId(),
            'platformId' => $this->getPlatformId(),
            'remoteId' => $this->getRemoteId(),
            'emailTemplateId' => $this->getEmailTemplateId(),
            'mobileLicences' => $this->getMobileLicences(),
            'authType' => $this->getAuthType(),
            'ldapServer' => $this->getLdapServer(),
            'ldapQuery' => $this->getLdapQuery(),
            'description' => $this->getDescription(),
            'proxyHost' => $this->getProxyHost(),
            'proxyPort' => $this->getProxyPort(),
            'sdes' => $this->getSdes(),
            'transport' => $this->getTransport(),
            'cardDav' => $this->getCardDav(),
            'cardDavPass' => $this->getCardDavPass(),
            'customTabUrl' => $this->getCustomTabUrl(),
            'voiceMailNumber' => $this->getVoiceMailNumber(),
            'customTabTitle' => $this->getCustomTabTitle(),
            'dualLicences' => $this->getDualLicences(),
            'displayDnd' => $this->getDisplayDnd(),
            'activationDate' => $this->getActivationDate(),
            'intRef' => $this->getIntRef(),
            'intRefUrl' => $this->getIntRefUrl(),
            'lastSuccessfulSync' => $this->getLastSuccessfulSync(),
            'id' => $this->getId()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setIden(string $iden): static
    {
        $this->iden = $iden;

        return $this;
    }

    public function getIden(): ?string
    {
        return $this->iden;
    }

    public function setDomain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDesktopLicenses(int $desktopLicenses): static
    {
        $this->desktopLicenses = $desktopLicenses;

        return $this;
    }

    public function getDesktopLicenses(): ?int
    {
        return $this->desktopLicenses;
    }

    public function setProvisioningTemplateId(int $provisioningTemplateId): static
    {
        $this->provisioningTemplateId = $provisioningTemplateId;

        return $this;
    }

    public function getProvisioningTemplateId(): ?int
    {
        return $this->provisioningTemplateId;
    }

    public function setPlatformId(int $platformId): static
    {
        $this->platformId = $platformId;

        return $this;
    }

    public function getPlatformId(): ?int
    {
        return $this->platformId;
    }

    public function setRemoteId(?int $remoteId): static
    {
        $this->remoteId = $remoteId;

        return $this;
    }

    public function getRemoteId(): ?int
    {
        return $this->remoteId;
    }

    public function setEmailTemplateId(int $emailTemplateId): static
    {
        $this->emailTemplateId = $emailTemplateId;

        return $this;
    }

    public function getEmailTemplateId(): ?int
    {
        return $this->emailTemplateId;
    }

    public function setMobileLicences(int $mobileLicences): static
    {
        $this->mobileLicences = $mobileLicences;

        return $this;
    }

    public function getMobileLicences(): ?int
    {
        return $this->mobileLicences;
    }

    public function setAuthType(string $authType): static
    {
        $this->authType = $authType;

        return $this;
    }

    public function getAuthType(): ?string
    {
        return $this->authType;
    }

    public function setLdapServer(?string $ldapServer): static
    {
        $this->ldapServer = $ldapServer;

        return $this;
    }

    public function getLdapServer(): ?string
    {
        return $this->ldapServer;
    }

    public function setLdapQuery(?string $ldapQuery): static
    {
        $this->ldapQuery = $ldapQuery;

        return $this;
    }

    public function getLdapQuery(): ?string
    {
        return $this->ldapQuery;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setProxyHost(?string $proxyHost): static
    {
        $this->proxyHost = $proxyHost;

        return $this;
    }

    public function getProxyHost(): ?string
    {
        return $this->proxyHost;
    }

    public function setProxyPort(?int $proxyPort): static
    {
        $this->proxyPort = $proxyPort;

        return $this;
    }

    public function getProxyPort(): ?int
    {
        return $this->proxyPort;
    }

    public function setSdes(string $sdes): static
    {
        $this->sdes = $sdes;

        return $this;
    }

    public function getSdes(): ?string
    {
        return $this->sdes;
    }

    public function setTransport(string $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    public function setCardDav(int $cardDav): static
    {
        $this->cardDav = $cardDav;

        return $this;
    }

    public function getCardDav(): ?int
    {
        return $this->cardDav;
    }

    public function setCardDavPass(?string $cardDavPass): static
    {
        $this->cardDavPass = $cardDavPass;

        return $this;
    }

    public function getCardDavPass(): ?string
    {
        return $this->cardDavPass;
    }

    public function setCustomTabUrl(string $customTabUrl): static
    {
        $this->customTabUrl = $customTabUrl;

        return $this;
    }

    public function getCustomTabUrl(): ?string
    {
        return $this->customTabUrl;
    }

    public function setVoiceMailNumber(string $voiceMailNumber): static
    {
        $this->voiceMailNumber = $voiceMailNumber;

        return $this;
    }

    public function getVoiceMailNumber(): ?string
    {
        return $this->voiceMailNumber;
    }

    public function setCustomTabTitle(string $customTabTitle): static
    {
        $this->customTabTitle = $customTabTitle;

        return $this;
    }

    public function getCustomTabTitle(): ?string
    {
        return $this->customTabTitle;
    }

    public function setDualLicences(int $dualLicences): static
    {
        $this->dualLicences = $dualLicences;

        return $this;
    }

    public function getDualLicences(): ?int
    {
        return $this->dualLicences;
    }

    public function setDisplayDnd(int $displayDnd): static
    {
        $this->displayDnd = $displayDnd;

        return $this;
    }

    public function getDisplayDnd(): ?int
    {
        return $this->displayDnd;
    }

    public function setActivationDate(\DateTimeInterface|string $activationDate): static
    {
        $this->activationDate = $activationDate;

        return $this;
    }

    public function getActivationDate(): \DateTimeInterface|string|null
    {
        return $this->activationDate;
    }

    public function setIntRef(string $intRef): static
    {
        $this->intRef = $intRef;

        return $this;
    }

    public function getIntRef(): ?string
    {
        return $this->intRef;
    }

    public function setIntRefUrl(string $intRefUrl): static
    {
        $this->intRefUrl = $intRefUrl;

        return $this;
    }

    public function getIntRefUrl(): ?string
    {
        return $this->intRefUrl;
    }

    public function setLastSuccessfulSync(null|\DateTimeInterface|string $lastSuccessfulSync): static
    {
        $this->lastSuccessfulSync = $lastSuccessfulSync;

        return $this;
    }

    public function getLastSuccessfulSync(): \DateTimeInterface|string|null
    {
        return $this->lastSuccessfulSync;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
