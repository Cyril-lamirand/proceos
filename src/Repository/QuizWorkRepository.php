<?php

namespace App\Repository;

use App\Entity\QuizWork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuizWork|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizWork|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizWork[]    findAll()
 * @method QuizWork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizWorkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizWork::class);
    }

    // /**
    //  * @return QuizWork[] Returns an array of QuizWork objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizWork
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
