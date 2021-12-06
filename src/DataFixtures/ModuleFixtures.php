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
        $intervenants = $manager->getRepository(User::class)->findBy(['roles' => ["ROLE_INTERVENANT"]]);
        $classe = $manager->getRepository(Classe::class)->findOneBy(['label' => "4emme année DW"]);

        foreach ($intervenants as $int) {
            $module = new Module();
            $module->setUser($int)
                ->setCreatedat(new DateTime('NOW'))
                ->setClasse($classe);
            $manager->persist($module);
        }
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
