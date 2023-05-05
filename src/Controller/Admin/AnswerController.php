<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/answer')]
class AnswerController extends AbstractController
{
    #[Route('/', name: 'answer_index', methods: ['GET'])]
    public function index(AnswerRepository $answerRepository): Response
    {
        return $this->render('server/answer/index.html.twig', [
            'answers' => $answerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'answer_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $answer = new Answer();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('server/answer/new.html.twig', compact('answer', 'form'));
    }

    #[Route('/{id}', name: 'answer_show', methods: ['GET'])]
    public function show(Answer $answer): Response
    {
        return $this->render('server/answer/show.html.twig', compact('answer'));
    }

    #[Route('/{id}/edit', name: 'answer_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Answer $answer): Response
    {
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('server/answer/edit.html.twig', compact('answer', 'form'));
    }

    #[Route('/{id}', name: 'answer_delete', methods: ['POST'])]
    public function delete(Request $request, Answer $answer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$answer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($answer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
