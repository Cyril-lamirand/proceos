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
        $module = $manager->getRepository(Module::class)->findAll();

        $course = new Course();
        $course->setTitle("Test cours")
        ->setCreatedat(new DateTime('NOW'))
        ->setContent("Description du cours test")
        ->setModule($module[0]);

        $manager->persist($course);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ModuleFixtures::class
        ];
    }
}
