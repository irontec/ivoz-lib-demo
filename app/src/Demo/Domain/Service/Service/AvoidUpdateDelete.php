<?php

namespace Demo\Domain\Service\Service;

use Demo\Domain\Model\Service\Service;
use Demo\Domain\Model\Service\ServiceInterface;

class AvoidUpdateDelete implements ServiceLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_HIGH;
    const PRE_REMOVE_PRIORITY = self::PRIORITY_HIGH;

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    public function execute(ServiceInterface $service): void
    {
        if ($service->isNew()) {
            return;
        }

        $iden = $service->getInitialValue('iden');

        if (in_array($iden, Service::BUILTIN_SERVICES)) {
            $msg = $service->hasBeenDeleted()
                ? 'Service ' . $iden . 'can’t be deleted'
                : 'Service ' . $iden . 'can’t be edited';

            throw new \DomainException($msg);
        }
    }
}