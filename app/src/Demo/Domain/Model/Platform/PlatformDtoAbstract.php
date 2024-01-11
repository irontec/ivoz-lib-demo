<?php

namespace Demo\Domain\Model\Platform;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;

/**
* PlatformDtoAbstract
* @codeCoverageIgnore
*/
abstract class PlatformDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $apiUrl = null;

    /**
     * @var string|null
     */
    private $refreshToken = null;

    /**
     * @var int|null
     */
    private $tlsPort = null;

    /**
     * @var string|null
     */
    private $type = 'isbc';

    /**
     * @var int|null
     */
    private $tcpPort = 5060;

    /**
     * @var int|null
     */
    private $udpPort = 5060;

    /**
     * @var int|null
     */
    private $wssPort = 10081;

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
            'name' => 'name',
            'apiUrl' => 'apiUrl',
            'refreshToken' => 'refreshToken',
            'tlsPort' => 'tlsPort',
            'type' => 'type',
            'tcpPort' => 'tcpPort',
            'udpPort' => 'udpPort',
            'wssPort' => 'wssPort',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'apiUrl' => $this->getApiUrl(),
            'refreshToken' => $this->getRefreshToken(),
            'tlsPort' => $this->getTlsPort(),
            'type' => $this->getType(),
            'tcpPort' => $this->getTcpPort(),
            'udpPort' => $this->getUdpPort(),
            'wssPort' => $this->getWssPort(),
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setApiUrl(?string $apiUrl): static
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function setRefreshToken(?string $refreshToken): static
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setTlsPort(int $tlsPort): static
    {
        $this->tlsPort = $tlsPort;

        return $this;
    }

    public function getTlsPort(): ?int
    {
        return $this->tlsPort;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setTcpPort(int $tcpPort): static
    {
        $this->tcpPort = $tcpPort;

        return $this;
    }

    public function getTcpPort(): ?int
    {
        return $this->tcpPort;
    }

    public function setUdpPort(int $udpPort): static
    {
        $this->udpPort = $udpPort;

        return $this;
    }

    public function getUdpPort(): ?int
    {
        return $this->udpPort;
    }

    public function setWssPort(int $wssPort): static
    {
        $this->wssPort = $wssPort;

        return $this;
    }

    public function getWssPort(): ?int
    {
        return $this->wssPort;
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
