<?php

namespace App\Repository;

use App\Entity\Textbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Textbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Textbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Textbook[]    findAll()
 * @method Textbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextbookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Textbook::class);
    }

    // /**
    //  * @return Textbook[] Returns an array of Textbook objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Textbook
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
