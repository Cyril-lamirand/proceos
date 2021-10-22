<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $array = [
            ["firstname" => "Alexis", "lastname" => "Bougy", "password" => "motdepasse", "roles" => ["ROLE_INTERVENANT"], "email" => "alexis.bougy@edu.devinci.fr"],
            ["firstname" => "Admin", "lastname" => "Admin", "password" => "motdepasse", "roles" => ["ROLE_ADMIN"], "email" => "admin@admin.fr"],
            ["firstname" => "IIM", "lastname" => " ", "password" => "motdepasse", "roles" => ["ROLE_ORGA_ADMIN"], "email" => "iim@iim.fr"],
            ["firstname" => "Mathias", "lastname" => "Gilles", "password" => "motdepasse", "roles" => ["ROLE_STUDENT"], "email" => "mathias.gilles@edu.devinci.fr"],
            ["firstname" => "Cyril", "lastname" => "Lamirand", "password" => "motdepasse", "roles" => ["ROLE_STUDENT"], "email" => "cyril.lamirand@edu.devinci.fr"],
            ["firstname" => "Victor", "lastname" => "Gaubin", "password" => "motdepasse", "roles" => ["ROLE_STUDENT"], "email" => "victor.gaubin@edu.devinci.fr"],
            ["firstname" => "Rayane", "lastname" => "Costet", "password" => "motdepasse", "roles" => ["ROLE_STUDENT"], "email" => "rayane.costet@edu.devinci.fr"],
            ["firstname" => "Mehdi", "lastname" => "Alibenyahia", "password" => "motdepasse", "roles" => ["ROLE_STUDENT"], "email" => "medhi.alibenyahia@edu.devinci.fr"],
            ["firstname" => "Lucas", "lastname" => "Beriot", "password" => "motdepasse", "roles" => ["ROLE_STUDENT"], "email" => "lucas.beriot@edu.devinci.fr"]
        ];

        foreach ($array as $el) {
            $user = new User();
            $user->setEmail($el['email'])
                ->setRoles($el['roles'])
                ->setFirstname($el['firstname'])
                ->setLastname($el['lastname'])
                ->setPassword($this->passwordHasher->hashPassword($user, $el['password']));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
