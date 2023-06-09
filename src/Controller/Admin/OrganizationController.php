<?php

namespace App\Controller\Admin;

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

#[Route('admin/organization')]
class OrganizationController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/', name: 'organization_index', methods: ['GET'])]
    public function index(OrganizationRepository $organizationRepository): Response
    {
        $user = $this->getUser();
        if (in_array('ROLE_ORGA_ADMIN', $user?->getRoles(), false)) {
            $userFromDb = $this->em->getRepository(User::class)->findOneBy(['email' => $user?->getUserIdentifier()]);
            if ($userFromDb){
                $organizations[] = $userFromDb->getOrganization();
            }
        } else {
            $organizations = $organizationRepository->findAll();
        }
        return $this->render('server/organization/index.html.twig', compact('organizations'));
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

            $this->em->persist($organization);
            $this->em->flush();

            return $this->redirectToRoute('organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/organization/new.html.twig', [
            'organization' => $organization,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'organization_show', methods: ['GET'])]
    public function show(Organization $organization): Response
    {
        return $this->render('server/organization/show.html.twig', compact('organization'));
    }

    #[Route('/{id}/edit', name: 'organization_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Organization $organization): Response
    {
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('server/organization/edit.html.twig', [
            'organization' => $organization,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'organization_delete', methods: ['POST'])]
    public function delete(Request $request, Organization $organization): Response
    {
        if ($this->isCsrfTokenValid('delete' . $organization->getId(), $request->request->get('_token'))) {

            $this->em->remove($organization);
            $this->em->flush();
        }

        return $this->redirectToRoute('organization_index', [], Response::HTTP_SEE_OTHER);
    }
}
