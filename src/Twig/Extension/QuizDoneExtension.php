<?php

declare(strict_types=1);

namespace App\Twig\Extension;

use App\Entity\Quiz;
use App\Entity\QuizWork;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class QuizDoneExtension extends AbstractExtension
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('quizDone', [$this, 'quizDone']),
        ];
    }

    public function quizDone(Quiz $quiz, User $user): bool
    {
        foreach ($user->getQuizWorks() as $quizWork) {
            if ($quizWork->getQuiz() === $quiz) {
                return true;
            }
        }

        return false;
    }
}