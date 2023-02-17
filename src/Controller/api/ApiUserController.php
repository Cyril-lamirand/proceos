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

    #[Route('/api/user/{id}', name: 'api_get_user', methods: 'get')]
    public function apiGetOneUserById($id): JsonResponse
    {
        $user = $this->userRepository->findOneBy(["id" => $id]);
        if ($user) {
            $jsonRes = [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "firstname" => $user->getFirstname(),
                "lastname" => $user->getLastname(),
                "organization" => [
                    "id" => $user->getOrganization()->getId(),
                    "label" => $user->getOrganization()->getLabel()
                ],
                "roles" => $user->getRoles(),
                "avatar" => [
                    "topType" => $user->getUserAvatar()->getTopType(),
                    "skinColor" => $user->getUserAvatar()->getSkinColor(),
                    "mouthType" => $user->getUserAvatar()->getMouthType(),
                    "hairColor" => $user->getUserAvatar()->getHairColor(),
                    "facialHairType" => $user->getUserAvatar()->getFacialHairType(),
                    "eyebrowType" => $user->getUserAvatar()->getEyebrowType(),
                    "clotheType" => $user->getUserAvatar()->getClotheType(),
                    "accessoriesType" => $user->getUserAvatar()->getAccessoriesType(),
                    "eyeType" => $user->getUserAvatar()->getEyeType()
                ]
            ];
        } else {
            $jsonRes = [
              "status" => 500,
              "message" => "Utilisateur introuvable"
            ];
        }
        return new JsonResponse($jsonRes);
    }

    #[Route('/api/login', name: 'api_login', methods: ['GET','POST'])]
    public function apiLogin(Request $request): JsonResponse
    {
        $form = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        // Main Infos
        $user = $this->userRepository->findOneBy(["email" => $form["email"]]);
        // Get Class
        $class = $user->getClasses();
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
                    "class"=> $class,
                    "roles" => $user->getRoles(),
                    "avatar" => [
                        "topType" => $user->getUserAvatar()?->getTopType(),
                        "skinColor" => $user->getUserAvatar()?->getSkinColor(),
                        "mouthType" => $user->getUserAvatar()?->getMouthType(),
                        "hairColor" => $user->getUserAvatar()?->getHairColor(),
                        "facialHairType" => $user->getUserAvatar()?->getFacialHairType(),
                        "eyebrowType" => $user->getUserAvatar()?->getEyebrowType(),
                        "clotheType" => $user->getUserAvatar()?->getClotheType(),
                        "accessoriesType" => $user->getUserAvatar()?->getAccessoriesType(),
                        "eyeType" => $user->getUserAvatar()?->getEyeType()
                    ]
                ]
            ];
        } else {
            $arrayCollection = [
                "request" => [
                    "status" => 500,
                    "message" => "Authentification failed",
                ]
            ];
        }
        return new JsonResponse($arrayCollection);
    }

    #[Route('/api/register', name: 'api_register', methods: 'post')]
    public function apiRegister(Request $request): JsonResponse
    {
        $values = json_decode($request->getContent(), true);
        $emailIsTaken = $this->userRepository->findOneBy(["email" => $values["email"]]);

        if ($emailIsTaken) {
            $arrayCollection = [
                "status" => 200,
                "message" => "L'adresse email existe déjà !"
            ];
        } else {
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

            // Find the user we just create. I know, not so fabulous.
            $user_avatar = $this->userRepository->findOneBy(["email" => $values["email"]]);
            // Create the Avatar
            $avatar = new UserAvatar();
            $avatar
                ->setTopType("LongHairStraight")
                ->setSkinColor("Light")
                ->setMouthType("Default")
                ->setHairColor("BrownDark")
                ->setFacialHairType("Blank")
                ->setEyeType("Default")
                ->setEyebrowType("Default")
                ->setClotheType("BlazerShirt")
                ->setAccessoriesType("Blank")
                ->setUser($user_avatar)
            ;
            $this->entityManager->persist($avatar);
            $this->entityManager->flush();

            // TODO : Send an email !

            $arrayCollection = [
                "status" => 200,
                "message" => "Utilisateur enregistre en base de donnees !"
            ];
        }
        return new JsonResponse($arrayCollection);
    }

    #[Route('/api/save_avatar', name: 'api_save_avatar', methods: ['PUT'])]
    public function apiUserAvatar(Request $request): JsonResponse
    {
        $values = json_decode($request->getContent(), true);
        $user = $this->userRepository->findOneBy(["id" => $values["id"]]);

        if (!$user) {
            $arrayCollection = [
                "status" => 500,
                "message" => "Utilisateur introuvable"
            ];
        } else {
            $userAvatar = $this->userAvatarRepository->findOneBy(["user" => $user]);
            $newAvatar = $userAvatar
                ->setAccessoriesType($values["accessoriesType"])
                ->setClotheType($values["clotheType"])
                ->setEyebrowType($values["eyebrowType"])
                ->setEyeType($values["eyeType"])
                ->setFacialHairType($values["facialHairType"])
                ->setHairColor($values["hairColor"])
                ->setMouthType($values["mouthType"])
                ->setSkinColor($values["skinColor"])
                ->setTopType($values["topType"])
            ;
            // Register in DB
            $this->entityManager->persist($newAvatar);
            $this->entityManager->flush();
            // Return message
            $arrayCollection = [
                "status" => 200,
                "message" => "Avatar enregistré !"
            ];
        }
        return new JsonResponse($arrayCollection);
    }
}