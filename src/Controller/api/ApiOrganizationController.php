<?php

namespace App\Controller\api;

use App\Repository\OrganizationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiOrganizationController extends AbstractController
{
    private $entityManager;
    private $organisationRepository;

    /**
     * ApiController constructor.
     * @param OrganizationRepository $organisationRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        OrganizationRepository $organisationRepository,
        EntityManagerInterface $entityManager,
    )
    {
        $this->entityManager = $entityManager;
        $this->organisationRepository = $organisationRepository;
    }

    #[Route('/api/organization', name: 'api_organization', methods: 'get')]
    public function apiOrganization()
    {
        $organizations = $this->organisationRepository->findAll();

        $arrayCollection = array();

        foreach ($organizations as $organization) {
            array_push($arrayCollection, [
                "id" => $organization->getId(),
                "label" => $organization->getLabel()
            ]);
        }

        return new JsonResponse($arrayCollection);
    }
}