<?php

namespace App\Controller\Admin;

use App\Entity\ExerciceWork;
use App\Form\ExerciceWorkType;
use App\Repository\ExerciceWorkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/exercice_work')]
class ExerciceWorkController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/', name: 'exercice_work_index', methods: ['GET'])]
    public function index(ExerciceWorkRepository $exerciceWorkRepository): Response
    {
        return $this->render('server/exercice_work/index.html.twig', [
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
            $this->em->persist($exerciceWork);
            $this->em->flush();

            return $this->redirectToRoute('exercice_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/exercice_work/new.html.twig', [
            'exercice_work' => $exerciceWork,
            'form' => $form->createView(),
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
            $this->em->flush();

            return $this->redirectToRoute('exercice_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/exercice_work/edit.html.twig', [
            'exercice_work' => $exerciceWork,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'exercice_work_delete', methods: ['POST'])]
    public function delete(Request $request, ExerciceWork $exerciceWork): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exerciceWork->getId(), $request->request->get('_token'))) {
            $this->em->remove($exerciceWork);
            $this->em->flush();
        }

        return $this->redirectToRoute('exercice_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
