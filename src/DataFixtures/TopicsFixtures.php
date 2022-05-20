<?php

namespace App\DataFixtures;

use App\Entity\Forum;
use App\Entity\Topic;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TopicsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $forums = $manager->getRepository(Forum::class)->findAll();
        $users = $manager->getRepository(User::class)->findByRole("ROLE_STUDENT");

        foreach ($forums as $forum) {
            $topic = new Topic();
            $topic->setTitle("Test topic")
                ->setCreatedat(new DateTime('NOW'))
                ->setForum($forum)
                ->setUser($users[array_rand($users, 1)]);
            $manager->persist($topic);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ForumFixtures::class
        ];
    }
}
