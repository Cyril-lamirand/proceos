<?php

namespace App\Controller;

use App\Entity\ExerciceWork;
use App\Form\ExerciceWorkType;
use App\Repository\ExerciceWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('proceos/exercice_work')]
class ExerciceWorkController extends AbstractController
{
    #[Route('/', name: 'exercice_work_index', methods: ['GET'])]
    public function index(ExerciceWorkRepository $exerciceWorkRepository): Response
    {
        return $this->render('exercice_work/index.html.twig', [
            'exercice_works' => $exerciceWorkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'exercice_work_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $exerciceWork = new ExerciceWork();
        $form = $this->createForm(ExerciceWorkType::class, $exerciceWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exerciceWork);
            $entityManager->flush();

            return $this->redirectToRoute('exercice_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exercice_work/new.html.twig', [
            'exercice_work' => $exerciceWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'exercice_work_show', methods: ['GET'])]
    public function show(ExerciceWork $exerciceWork): Response
    {
        return $this->render('exercice_work/show.html.twig', [
            'exercice_work' => $exerciceWork,
        ]);
    }

    #[Route('/{id}/edit', name: 'exercice_work_edit', methods: ['GET','POST'])]
    public function edit(Request $request, ExerciceWork $exerciceWork): Response
    {
        $form = $this->createForm(ExerciceWorkType::class, $exerciceWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exercice_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exercice_work/edit.html.twig', [
            'exercice_work' => $exerciceWork,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'exercice_work_delete', methods: ['POST'])]
    public function delete(Request $request, ExerciceWork $exerciceWork): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exerciceWork->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exerciceWork);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exercice_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
