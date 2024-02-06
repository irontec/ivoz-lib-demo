<?php

namespace Demo\Application\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorDto;
use Demo\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Core\Domain\Service\EntityTools;

class ActivateAdministrator
{
    public function __construct(
        private AdministratorRepository $administratorRepository,
        private EntityTools $entityTools
    ) {
    }

    public function execute(int $administratorId): void
    {
        $administrator = $this->administratorRepository->find($administratorId);

        if ($administrator === null) {
            throw new \DomainException('Administrator not found.', 404);
        }

        /** @var AdministratorDto $administratorDto */
        $administratorDto = $this->entityTools->entityToDto($administrator);
        $administratorDto->setActive(1);
        $this->entityTools->persistDto($administratorDto, $administrator);
    }
}
