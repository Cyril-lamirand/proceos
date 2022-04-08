<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Quiz;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuizFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $modules = $manager->getRepository(Module::class)->findAll();
        foreach ($modules as $module) {
            $quiz = new Quiz();
            $quiz->setCreatedat(new DateTime('NOW'))
                ->setLabel("Quiz Test")
                ->setModule($module);

            $manager->persist($quiz);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ModuleFixtures::class
        ];
    }
}
