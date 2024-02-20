<?php

namespace Demo\Domain\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorInterface;
use Psr\Log\LoggerInterface;

class SendActivationEmail implements AdministratorLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

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
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
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

        $this->sendActivationEmail->execute($administrator);
    }
}
