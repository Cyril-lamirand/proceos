<?php

namespace App\Controller\api;

use App\Repository\OrganizationRepository;
use App\Repository\UserAvatarRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiTeacherController extends AbstractController
{
    private $entityManager;
    private $organisationRepository;
    private $userRepository;
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
        UserRepository              $userRepository,
        OrganizationRepository      $organisationRepository,
        UserAvatarRepository        $userAvatarRepository,
        EntityManagerInterface      $entityManager,
        UserPasswordHasherInterface $encoder
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->organisationRepository = $organisationRepository;
        $this->userAvatarRepository = $userAvatarRepository;
        $this->encoder = $encoder;
    }

}
