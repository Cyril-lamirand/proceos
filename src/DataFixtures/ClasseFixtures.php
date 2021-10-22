<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Organization;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $students = $manager->getRepository(User::class)->findByRole("ROLE_STUDENT");
        $orga = $manager->getRepository(Organization::class)->findOneBy(['label' => "IIM"]);
        $intervenant = $manager->getRepository(User::class)->findOneBy(['email' => "alexis.bougy@edu.devinci.fr"]);

        $classe = new Classe();
        $classe->setLabel("4eme année DW")
            ->setOrganization($orga)
            ->addUser($intervenant);

        foreach ($students as $student) {
            $classe->addUser($student);
        }

        $manager->persist($classe);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            OrganizationFixtures::class,
        ];
    }
}
