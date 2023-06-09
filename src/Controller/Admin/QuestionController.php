<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/question')]
class QuestionController extends AbstractController
{
    // TODO : Show only Organization USER Question

    #[Route('/', name: 'question_index', methods: ['GET'])]
    public function index(QuestionRepository $questionRepository): Response
    {
        return $this->render('server/question/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'question_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'question_show', methods: ['GET'])]
    public function show(Question $question): Response
    {
        return $this->render('server/question/show.html.twig', compact('question'));
    }

    #[Route('/{id}/edit', name: 'question_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Question $question, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'question_delete', methods: ['POST'])]
    public function delete(Request $request, Question $question, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $em->remove($question);
            $em->flush();
        }

        return $this->redirectToRoute('question_index', [], Response::HTTP_SEE_OTHER);
    }
}
