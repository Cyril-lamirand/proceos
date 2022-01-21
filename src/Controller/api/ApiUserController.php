<?php

namespace App\Controller\api;

use App\Entity\User;
use App\Repository\OrganizationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
    private $entityManager;
    private $organisationRepository;
    private $userRepository;
    private $encoder;

    /**
     * ApiController constructor.
     * @param UserRepository $userRepository
     * @param OrganizationRepository $organisationRepository
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $encoder
     */
    public function __construct(
        UserRepository $userRepository,
        OrganizationRepository $organisationRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $encoder
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->organisationRepository = $organisationRepository;
        $this->encoder = $encoder;
    }

    #[Route('/api/login', name: 'api_login', methods: 'post')]
    public function apiLogin(Request $request)
    {
        $form = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["email" => $form["email"]]);
        if($this->encoder->isPasswordValid($user, $form["password"])) {
            $arrayCollection = [
                "request" => [
                    "status" => 200,
                    "message" => "Authentification OK !",
                ],
                "user" => [
                    "email" => $user->getEmail(),
                    "firstname" => $user->getFirstname(),
                    "lastname" => $user->getLastname(),
                    "organization" => [
                        "id" => $user->getOrganization()->getId(),
                        "label" => $user->getOrganization()->getLabel()
                    ],
                    "roles" => $user->getRoles()
                ]
            ];

            return new JsonResponse($arrayCollection);

        } else {
            $arrayCollection = [
                "request" => [
                    "status" => 500,
                    "message" => "Une erreur est survenue !",
                ]
            ];

            return new JsonResponse($arrayCollection);
        }

    }

    #[Route('/api/register', name: 'api_register', methods: 'post')]
    public function apiRegister(Request $request): JsonResponse
    {
        $values = json_decode($request->getContent(), true);
        // Create User
        $user = new User();
        // Main Informations
        $user->setEmail($values["email"]);
        $user->setFirstname($values["firstname"]);
        $user->setLastname($values["lastname"]);
        // Organization
        $user->setOrganization($this->organisationRepository->findOneBy(["id" => $values["organization"]]));
        // Roles
        if ($values["roles"] === "Étudiant") {
            $user->setRoles(["ROLE_STUDENT"]);
        } elseif ($values["roles"] === "Intervenant") {
            $user->setRoles(["ROLE_INTERVENANT"]);
        } else {
            $user->setRoles(["ROLE_ORGA_ADMIN"]);
        }
        // Encrypt
        $user->setPassword($this->encoder->hashPassword($user, $values["password"]));
        // Register
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // TODO : Check if everything is ok !

        // TODO : Send an email !

        $arrayCollection = [
            "status" => 200,
            "message" => "Utilisateur enregistre en base de donnees !"
        ];

        return new JsonResponse($arrayCollection);
    }

}