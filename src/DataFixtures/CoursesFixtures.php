<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Module;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CoursesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Module 1
        $module = $manager->getRepository(Module::class)->findAll();
        $course1 = new Course();
        $course1->setTitle("Symfony 6 - Débutant")
        ->setCreatedat(new DateTime('NOW'))
        ->setContent("Voici le cours concernant symfony 6 niveau débutant !")
        ->setModule($module[0]);
        $manager->persist($course1);
        $course2 = new Course();
        $course2->setTitle("Symfony 6 - Intermédiaire")
            ->setCreatedat(new DateTime('NOW'))
            ->setContent("Voici le cours concernant symfony 6 niveau intermédiaire !")
            ->setModule($module[0]);
        $manager->persist($course2);
        $course3 = new Course();
        $course3->setTitle("Symfony 6 - Avancé")
            ->setCreatedat(new DateTime('NOW'))
            ->setContent("Voici le cours concernant symfony 6 niveau avancé !")
            ->setModule($module[0]);
        $manager->persist($course3);

        // Module 2
        $course4 = new Course();
        $course4->setTitle("Python - Débutant")
            ->setCreatedat(new DateTime('NOW'))
            ->setContent("Voici le cours concernant python niveau débutant !")
            ->setModule($module[1]);
        $manager->persist($course4);
        $course5 = new Course();
        $course5->setTitle("Python - Intermédiaire")
            ->setCreatedat(new DateTime('NOW'))
            ->setContent("Voici le cours concernant python niveau intermédiaire !")
            ->setModule($module[1]);
        $manager->persist($course5);
        $course6 = new Course();
        $course6->setTitle("Python - Avancé")
            ->setCreatedat(new DateTime('NOW'))
            ->setContent("Voici le cours concernant python niveau avancé !")
            ->setModule($module[1]);
        $manager->persist($course6);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ModuleFixtures::class
        ];
    }
}
