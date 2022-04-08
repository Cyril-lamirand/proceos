<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Quiz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $quizs = $manager->getRepository(Quiz::class)->findAll();
        foreach ($quizs as $q) {
            for ($i = 0; $i < 5; $i++) {
                $question = new Question();
                $question->setQuiz($q)
                    ->setLabel("Test label question n°" . $i)
                    ->setPlaceholder("Placeholder question n°" . $i)
                    ->setType('text');
                $manager->persist($question);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            QuizFixtures::class
        ];
    }
}
