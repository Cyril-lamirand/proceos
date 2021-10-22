<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrganizationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $array = [
            ["label" => "IIM"]
        ];

        foreach ($array as $el) {
            $organization = new Organization();
            $organization->setLabel($el['label']);
            $manager->persist($organization);
        }

        $manager->flush();
    }
}
