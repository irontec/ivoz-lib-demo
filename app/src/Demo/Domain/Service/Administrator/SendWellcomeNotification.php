<?php

namespace Demo\Domain\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorInterface;
use Psr\Log\LoggerInterface;

class SendWellcomeNotification implements AdministratorLifecycleEventHandlerInterface
{
    public const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
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

    public function execute(AdministratorInterface $administrator): void
    {
        if (!$administrator->isNew()) {
            return;
        }

        $isOk = false;

        if ($isOk) {
            $this->logger->log("Administrator account created");
        } else {
            $this->logger->error("Administration creation failed");
        }
    }
}
