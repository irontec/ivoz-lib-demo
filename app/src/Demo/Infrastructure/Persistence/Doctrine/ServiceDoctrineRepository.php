<?php

namespace Demo\Infrastructure\Persistence\Doctrine;

use Doctrine\Persistence\ManagerRegistry;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;
use Demo\Domain\Model\Service\Service;
use Demo\Domain\Model\Service\ServiceRepository;
use Demo\Domain\Model\Service\ServiceInterface;
use Demo\Domain\Model\Service\ServiceDto;

/**
 * ServiceDoctrineRepository
 *
 * This class was generated by ivoz:make:repositories command.
 * Add your own custom repository methods below.
 *
 * @extends DoctrineRepository<ServiceInterface, ServiceDto>
 */
class ServiceDoctrineRepository extends DoctrineRepository implements ServiceRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityPersisterInterface $entityPersisterInterface,
    ) {
        parent::__construct(
            $registry,
            Service::class,
            $entityPersisterInterface
        );
    }
}