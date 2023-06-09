<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\QuizWork;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/quiz-work')]
class QuizWorkController extends AbstractController
{
    #[Route(
        path: '/{id}',
        name: 'quiz_work_detail',
        methods: ['GET']
    )]
    public function show(QuizWork $quizWork): Response
    {
        return $this->render('client/quizWork/detail.html.twig', compact('quizWork'));
    }
}