<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/exercice')]
class ExerciceController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    // TODO : Show only Organization USER Exercice

    #[Route('/', name: 'exercice_index', methods: ['GET'])]
    public function index(ExerciceRepository $exerciceRepository): Response
    {
        return $this->render('server/exercice/index.html.twig', [
            'exercices' => $exerciceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'exercice_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $exercice = new Exercice();
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($exercice);
            $this->em->flush();

            return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'exercice_show', methods: ['GET'])]
    public function show(Exercice $exercice): Response
    {
        return $this->render('server/exercice/show.html.twig', compact('exercice'));
    }

    #[Route('/{id}/edit', name: 'exercice_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Exercice $exercice): Response
    {
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'exercice_delete', methods: ['POST'])]
    public function delete(Request $request, Exercice $exercice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            $this->em->remove($exercice);
            $this->em->flush();
        }

        return $this->redirectToRoute('exercice_index', [], Response::HTTP_SEE_OTHER);
    }
}
