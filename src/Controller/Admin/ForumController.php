<?php

namespace App\Controller\Admin;

use App\Entity\Forum;
use App\Form\ForumType;
use App\Repository\ForumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/forum')]
class ForumController extends AbstractController
{
    // TODO : Show only Organization USER Forum

    #[Route('/', name: 'forum_index', methods: ['GET'])]
    public function index(ForumRepository $forumRepository): Response
    {
        return $this->render('server/forum/index.html.twig', [
            'forums' => $forumRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'forum_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $forum = new Forum();
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forum);
            $entityManager->flush();

            return $this->redirectToRoute('forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('server/forum/new.html.twig', [
            'forum' => $forum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'forum_show', methods: ['GET'])]
    public function show(Forum $forum): Response
    {
        return $this->render('server/forum/show.html.twig', [
            'forum' => $forum,
        ]);
    }

    #[Route('/{id}/edit', name: 'forum_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Forum $forum): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('server/forum/edit.html.twig', [
            'forum' => $forum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'forum_delete', methods: ['POST'])]
    public function delete(Request $request, Forum $forum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forum_index', [], Response::HTTP_SEE_OTHER);
    }
}
