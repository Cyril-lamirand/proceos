<?php

namespace App\Controller\api;

use App\Entity\Organization;
use App\Repository\OrganizationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiModuleController extends AbstractController
{

    public function __construct(EntityManagerInterface $manager, OrganizationRepository $repo)
    {
        $this->manager = $manager;
        $this->repo = $repo;
    }

    /**
     * id => organization id
     */
    #[Route('/modules/{id}', name: 'api_modules', methods: 'get')]
    public function getAllModules(Organization $organization): JsonResponse
    {
        $organizationClassrooms = $organization->getClasses();
        $allModules = [];
        foreach ($organizationClassrooms as $classroom) {
            $modules = $classroom->getModules();

            foreach ($modules as $m) {
                $module = [
                    "id"=>$m->getId(),
                    "label" => $m->getLabel(),
                    "classroom"=>$m->getClasse()->getLabel()
                ];
                $allModules[] = $module;
            }
        }

        return new JsonResponse($allModules);
    }
}