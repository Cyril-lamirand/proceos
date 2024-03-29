<?php

namespace App\Controller\Admin;

use App\Entity\QuizWork;
use App\Form\QuizWorkType;
use App\Repository\QuizWorkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/quiz_work')]
class QuizWorkController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/', name: 'quiz_work_index', methods: ['GET'])]
    public function index(QuizWorkRepository $quizWorkRepository): Response
    {
        return $this->render('server/quiz_work/index.html.twig', [
            'quiz_works' => $quizWorkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'quiz_work_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $quizWork = new QuizWork();
        $form = $this->createForm(QuizWorkType::class, $quizWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($quizWork);
            $this->em->flush();

            return $this->redirectToRoute('quiz_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/quiz_work/new.html.twig', [
            'quiz_work' => $quizWork,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'quiz_work_show', methods: ['GET'])]
    public function show(QuizWork $quizWork): Response
    {
        return $this->render('server/quiz_work/show.html.twig', [
            'quiz_work' => $quizWork,
        ]);
    }

    #[Route('/{id}/edit', name: 'quiz_work_edit', methods: ['GET','POST'])]
    public function edit(Request $request, QuizWork $quizWork): Response
    {
        $form = $this->createForm(QuizWorkType::class, $quizWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('quiz_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/quiz_work/edit.html.twig', [
            'quiz_work' => $quizWork,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'quiz_work_delete', methods: ['POST'])]
    public function delete(Request $request, QuizWork $quizWork): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quizWork->getId(), $request->request->get('_token'))) {
            $this->em->remove($quizWork);
            $this->em->flush();
        }

        return $this->redirectToRoute('quiz_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
