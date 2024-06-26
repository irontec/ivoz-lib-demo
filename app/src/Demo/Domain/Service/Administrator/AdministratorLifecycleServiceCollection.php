<?php

namespace Demo\Domain\Service\Administrator;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class AdministratorLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Demo\Domain\Service\Administrator\SendActivationEmail::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceof($service, AdministratorLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
