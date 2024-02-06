<?php

namespace Demo\Domain\Service\Administrator;

use Demo\Domain\Model\Administrator\AdministratorInterface;

interface SendActivationEmailInterface
{
    public function execute(AdministratorInterface $administrator): void;
}
