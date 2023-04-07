<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Module;
use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(
        path: '/quiz/create/{id}',
        name: 'create_quiz',
        methods: ['POST', 'GET']
    )]
    public function create(Module $module): Response
    {
        return $this->render('client/teacher/create-quiz.html.twig', compact('module'));
    }

    #[Route(
        path: '/quiz/answer/{id}',
        name: 'answer_quiz',
        methods: ['POST', 'GET']
    )]
    public function answer(Quiz $quiz): Response
    {
        return $this->render('client/student/answer-quiz.html.twig', compact('quiz'));
    }
}