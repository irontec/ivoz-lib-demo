<?php

namespace Demo\Domain\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorInterface;
use Psr\Log\LoggerInterface;

class SendActivationEmail implements AdministratorLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private SendActivationEmailInterface $sendActivationEmail,
        private LoggerInterface $logger
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

    /**
     * @throws \DomainException
     */
    public function execute(AdministratorInterface $administrator): void
    {
        $isNew = $administrator->isNew();
        if (!$isNew) {
            return;
        }

        $isActive = $administrator->getActive();
        if ($isActive) {
            return;
        }

        $id = $administrator->getId();
        if ($id === null) {
            throw new \DomainException('Administrator not found');
        }

        $this->activationEmail->execute($administrator);

        $this->logger->info("Administrator created with Id {$id}");
    }
}
