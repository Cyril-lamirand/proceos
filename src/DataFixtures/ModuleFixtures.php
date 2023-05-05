<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $int = $manager->getRepository(User::class)->findOneBy(['email' => "alexis.bougy@edu.devinci.fr"]);
        $classe = $manager->getRepository(Classe::class)->findOneBy(['label' => "4eme année DW"]);
        $classe2 = $manager->getRepository(Classe::class)->findOneBy(['label' => "5eme année DW"]);

        $module = new Module();
        $module->setUser($int)
            ->setLabel("A4 - Module Symfony")
            ->setCreatedat(new DateTime('NOW'))
            ->setClasse($classe);
        $manager->persist($module);

        $module2 = new Module();
        $module2->setUser($int)
            ->setLabel("A5 - Module Python")
            ->setCreatedat(new DateTime('NOW'))
            ->setClasse($classe2);
        $manager->persist($module2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ClasseFixtures::class
        ];
    }
}
