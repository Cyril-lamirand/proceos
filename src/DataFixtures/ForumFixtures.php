<?php

namespace App\DataFixtures;

use App\Entity\Forum;
use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ForumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $organizations = $manager->getRepository(Organization::class)->findAll();

        foreach ($organizations as $orga) {
            $forum = new Forum();
            $forum->setOrganization($orga)
                ->setLabel("forum de" . " " . $orga->getLabel());
            $manager->persist($forum);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrganizationFixtures::class,
        ];
    }
}
