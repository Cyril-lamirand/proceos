<?php

namespace App\Controller\Admin;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/quiz')]
class QuizController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/', name: 'quiz_index', methods: ['GET'])]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('server/quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'quiz_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $quiz = new Quiz();
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($quiz);
            $this->em->flush();

            return $this->redirectToRoute('quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'quiz_show', methods: ['GET'])]
    public function show(Quiz $quiz): Response
    {
        return $this->render('server/quiz/show.html.twig', compact('quiz'));
    }

    #[Route('/{id}/edit', name: 'quiz_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Quiz $quiz): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'quiz_delete', methods: ['POST'])]
    public function delete(Request $request, Quiz $quiz): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quiz->getId(), $request->request->get('_token'))) {
            $this->em->remove($quiz);
            $this->em->flush();
        }

        return $this->redirectToRoute('quiz_index', [], Response::HTTP_SEE_OTHER);
    }
}
