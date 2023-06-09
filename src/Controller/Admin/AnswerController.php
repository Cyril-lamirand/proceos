<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/answer')]
class AnswerController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/', name: 'answer_index', methods: ['GET'])]
    public function index(AnswerRepository $answerRepository): Response
    {
        return $this->render('server/answer/index.html.twig', [
            'answers' => $answerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'answer_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($answer);
            $this->em->flush();

            return $this->redirectToRoute('answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/answer/new.html.twig', ['answer' => $answer, 'form' => $form->createView()]);
    }

    #[Route('/{id}', name: 'answer_show', methods: ['GET'])]
    public function show(Answer $answer): Response
    {
        return $this->render('server/answer/show.html.twig', compact('answer'));
    }

    #[Route('/{id}/edit', name: 'answer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Answer $answer): Response
    {
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/answer/edit.html.twig', ['answer' => $answer, 'form' => $form->createView()]);
    }

    #[Route('/{id}', name: 'answer_delete', methods: ['POST'])]
    public function delete(Request $request, Answer $answer): Response
    {
        if ($this->isCsrfTokenValid('delete' . $answer->getId(), $request->request->get('_token'))) {
            $this->em->remove($answer);
            $this->em->flush();
        }

        return $this->redirectToRoute('answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
