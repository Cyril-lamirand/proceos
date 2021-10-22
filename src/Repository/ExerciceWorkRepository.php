<?php

namespace App\Repository;

use App\Entity\ExerciceWork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExerciceWork|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceWork|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceWork[]    findAll()
 * @method ExerciceWork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceWorkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceWork::class);
    }

    // /**
    //  * @return ExerciceWork[] Returns an array of ExerciceWork objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExerciceWork
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
