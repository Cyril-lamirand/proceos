<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Module;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExerciceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $modules = $manager->getRepository(Module::class)->findAll();
        foreach ($modules as $m) {
            $exercice = new Exercice();
            $todayDate = new DateTime('NOW');
            $exercice->setTitle("Exercice test")
                ->setCreatedat(new DateTime('NOW'))
                ->setContent("Ceci est le content test de cette exercice")
                ->setDatelimit($todayDate->add(new DateInterval('P10D')))
                ->setModule($m)
                ->setContentbeginner("content exercice beginner.")
                ->setContentintermediate("content exercice intermediate.")
                ->setContentexpert("content exercice expert.");
            $manager->persist($exercice);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ModuleFixtures::class,
        ];
    }
}
