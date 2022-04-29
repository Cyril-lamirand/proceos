<?php

namespace App\Controller\api;

use App\Entity\User;
use App\Entity\UserAvatar;
use App\Repository\OrganizationRepository;
use App\Repository\UserAvatarRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
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
    private $userAvatarRepository;
    private $encoder;

    /**
     * ApiController constructor.
     * @param UserRepository $userRepository
     * @param OrganizationRepository $organisationRepository
     * @param UserAvatarRepository $userAvatarRepository
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $encoder
     */
    public function __construct(
        UserRepository $userRepository,
        OrganizationRepository $organisationRepository,
        UserAvatarRepository $userAvatarRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $encoder
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->organisationRepository = $organisationRepository;
        $this->userAvatarRepository = $userAvatarRepository;
        $this->encoder = $encoder;
    }

    #[Route('/api/login', name: 'api_login', methods: 'post')]
    public function apiLogin(Request $request): JsonResponse
    {
        $form = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["email" => $form["email"]]);
        if ($this->encoder->isPasswordValid($user, $form["password"])) {
            $arrayCollection = [
                "request" => [
                    "status" => 200,
                    "message" => "Authentification succeed",
                ],
                "user" => [
                    "id" => $user->getId(),
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
                    "message" => "Authentification failed",
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

    #[Route('/api/save_avatar', name: 'api_save_avatar', methods: ['POST', 'PUT'])]
    public function apiUserAvatar(Request $request): JsonResponse
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        switch ($httpMethod) {
            case 'POST':

                break;

            case 'PUT':

                break;

            default:
                echo "Default";
                break;
        }
        $jsonRes = [
            "method" => $httpMethod
        ];

        /**
        $values = json_decode($request->getContent(), true);
        // Set the Avatar
        $avatar = new UserAvatar();
        $avatar->setUser($this->userRepository->findOneBy(["id" => $values["id"]]));
        $avatar->setAccessoriesType($values["accessoriesType"]);
        $avatar->setClotheType($values["clotheType"]);
        $avatar->setEyebrowType($values["eyebrowType"]);
        $avatar->setEyeType($values["eyeType"]);
        $avatar->setFacialHairType($values["facialHairType"]);
        $avatar->setHairColor($values["hairColor"]);
        $avatar->setMouthType($values["mouthType"]);
        $avatar->setSkinColor($values["skinColor"]);
        $avatar->setTopType($values["topType"]);
        // Register in DB
        $this->entityManager->persist($avatar);
        $this->entityManager->flush();
        // Return message
        $arrayCollection = [
            "status" => 200,
            "message" => "Avatar enregistré !"
        ];
        $response = new JsonResponse($arrayCollection);
        return $response;
         **/

        return new JsonResponse($jsonRes);

    }

    #[Route('/api/get_avatar/{id}', name: 'api_get_avatar', methods: ['GET'])]
    public function apiGetUserAvatar($id): JsonResponse
    {
        try {
            $user = $this->userAvatarRepository->findOneBy(["user" => $id]);
            if (!$user) {
                $jsonRes = [
                    "message" => "Avatar retrieve failed"
                ];
            } else {
                $jsonRes = [
                    "accessoriesType" => $user->getTopType(),
                    "clotheType" => $user->getClotheType(),
                    "eyebrowType" => $user->getEyebrowType(),
                    "facialHairType" => $user->getFacialHairType(),
                    "hairColor" => $user->getHairColor(),
                    "mouthType" => $user->getMouthType(),
                    "skinColor" => $user->getSkinColor(),
                    "topType" => $user->getTopType()
                ];
            }
        } catch (Exception $e) {
            $jsonRes = [
                "error" => $e
            ];
        }
        return new JsonResponse($jsonRes);
    }
}