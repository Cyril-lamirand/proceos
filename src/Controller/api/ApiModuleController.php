<?php

namespace App\Controller\api;

use App\Entity\Module;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiModuleController extends AbstractController
{
    private $em;

    public function __construct(
        EntityManagerInterface $entityManager,
    )
    {
        $this->em = $entityManager;
    }

    #[Route('/modules/intervenant/{id}', name: 'api_get_modules', methods: 'get')]
    public function getModulesByIntervenant($id): JsonResponse
    {
        $modules = $this->em->getRepository(Module::class)->findModulesByInterevenant($id);
        if ($modules) {
            $returnedArray = [];
            foreach ($modules as $item) {
                $itemArray = [
                    'id' => $item->getId(),
                    'name' => $item->getLabel(),
                ];
                $returnedArray[] = $itemArray;
            }
            return new JsonResponse($returnedArray);
        }

        return new JsonResponse(["Error" => "Aucun module pour cet intervenant"]);
    }
}