<?php

namespace Demo\Stub\DataFixtures\ORM;

use Demo\Domain\Model\Administrator\Administrator;
use Demo\Stub\AdministratorStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Demo\Stub\DataFixtures\FixtureHelperTrait;

class AdministratorFixture extends Fixture
{
    use FixtureHelperTrait;

    public function __construct(
        private AdministratorStub $adminStub
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(Administrator::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->adminStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_Administrator' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
