<?php

namespace App\Controller;

use App\Entity\Organization;
use App\Entity\User;
use App\Form\OrganizationType;
use App\Repository\OrganizationRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('proceos/organization')]
class OrganizationController extends AbstractController
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'organization_index', methods: ['GET'])]
    public function index(OrganizationRepository $organizationRepository): Response
    {
        $user = $this->getUser();
        if (in_array('ROLE_ORGA_ADMIN', $user?->getRoles(), true)) {
            $userFromDb = $this->em->getRepository(User::class)->findOneBy(['email' => $user?->getUserIdentifier()]);
            if ($userFromDb){
                $organizations[] = $userFromDb->getOrganization();
            }
        } else {
            $organizations = $organizationRepository->findAll();
        }
        return $this->render('organization/index.html.twig', [
            'organizations' => $organizations,
        ]);
    }

    #[Route('/new', name: 'organization_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $logo = $form->get('logo')->getData();
            if ($logo) {
                $fileUploader = new FileUploader($this->getParameter('organizations'), $slugger);
                $logoName = $fileUploader->upload($logo);
                $organization->setLogo($logoName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organization);
            $entityManager->flush();

            return $this->redirectToRoute('organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organization/new.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'organization_show', methods: ['GET'])]
    public function show(Organization $organization): Response
    {
        return $this->render('organization/show.html.twig', [
            'organization' => $organization,
        ]);
    }

    #[Route('/{id}/edit', name: 'organization_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Organization $organization): Response
    {
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organization/edit.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'organization_delete', methods: ['POST'])]
    public function delete(Request $request, Organization $organization): Response
    {
        if ($this->isCsrfTokenValid('delete' . $organization->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($organization);
            $entityManager->flush();
        }

        return $this->redirectToRoute('organization_index', [], Response::HTTP_SEE_OTHER);
    }
}
