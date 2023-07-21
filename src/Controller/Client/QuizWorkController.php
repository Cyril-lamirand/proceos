<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\QuizWork;
use App\Entity\StudentLevel;
use App\Form\StudentLevelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/quiz-work')]
class QuizWorkController extends AbstractController
{
    #[Route(
        path: '/{id}',
        name: 'quiz_work_detail',
        methods: ['GET', 'POST']
    )]
    public function show(QuizWork $quizWork, Request $request, EntityManagerInterface $manager): Response
    {
        $module = $quizWork->getQuiz()->getModule();

        $studentLevel = new StudentLevel();
        $studentLevel->setModule($quizWork->getQuiz()->getModule());
        $studentLevel->setUser($quizWork->getUser());

        $form = $this->createForm(StudentLevelType::class, $studentLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($studentLevel);
            $manager->flush();
            return $this->redirectToRoute('dashboard', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/quizWork/detail.html.twig', [
            "form" => $form->createView(),
            "quizWork" => $quizWork
        ]);
    }
}