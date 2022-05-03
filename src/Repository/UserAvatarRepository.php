<?php

namespace App\Repository;

use App\Entity\UserAvatar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserAvatar|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAvatar|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAvatar[]    findAll()
 * @method UserAvatar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAvatarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAvatar::class);
    }

    // /**
    //  * @return UserAvatar[] Returns an array of UserAvatar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserAvatar
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
