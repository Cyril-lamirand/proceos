<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Module;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(
        path: '/quizz/create/{id}',
        name: 'create_quizz'
    )]
    public function create(Module $module, Request $request)
    {

        return $this->render('client/teacher/create-quiz.html.twig');
    }
}