<?php

namespace Demo\Domain\Service\Client;

use Demo\Domain\Model\Client\ClientDto;
use Demo\Domain\Model\Client\Client;
use Demo\Domain\Model\Client\ClientInterface;
use Demo\Domain\Model\Client\ClientRepository;
use Demo\Domain\Model\Platform\PlatformInterface;
use Demo\Domain\Service\Platform\PlatformLifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\EntityTools;

class CreateByPlatform implements PlatformLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private ClientRepository $clientRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(PlatformInterface $platform): void
    {
        $platformId = $platform->getId();

        $client = $this->clientRepository->findByPlatformId($platformId);
        $clientDto = $client
            ? $this->entityTools->entityToDto($client)
            : new ClientDto();

        $clientDto
            ->setIden(Client::DEFAULT_PLATFORM_CLIENT_PREFIX . $platformId)
            ->setDomain('sip.example.com')
            ->setDesktopLicenses(10)
            ->setProvisioningTemplateId(3)
            ->setPlatformId($platformId)
            ->setEmailTemplateId(3)
            ->setMobileLicences(33)
            ->setAuthType(ClientInterface::AUTHTYPE_PASSWORD)
            ->setSdes('required')
            ->setTransport('tls+sip:')
            ->setCardDav(33)
            ->setCustomTabUrl('ctu.com')
            ->setVoiceMailNumber('*93')
            ->setCustomTabTitle('custtt')
            ->setDualLicences(33)
            ->setDisplayDnd(1)
            ->setActivationDate(new \DateTime())
            ->setIntRef('')
            ->setIntRefUrl('dubi.example.com');


        $responseClient = $this->clientRepository->persistDto($clientDto, $client);
    }
}
