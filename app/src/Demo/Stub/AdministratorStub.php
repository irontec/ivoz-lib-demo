<?php

namespace Demo\Stub;

use Demo\Domain\Model\Administrator\Administrator;
use Demo\Domain\Model\Administrator\AdministratorDto;

class AdministratorStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Administrator::class;
    }

    protected function load()
    {
        $dto = (new AdministratorDto(1))
            ->setUsername('admin')
            ->setPass('changeme')
            ->setEmail('testAdmin@irontec.com')
            ->setName('Name')
            ->setLastname('Last name');

        $this->append($dto);

        $dto2 = (new AdministratorDto(2))
            ->setUsername('another_admin')
            ->setPass('changeme')
            ->setEmail('admin2@irontec.com')
            ->setName('Name')
            ->setLastname('Last name');

        $this->append($dto2);
    }
}
