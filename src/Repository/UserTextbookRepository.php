<?php

namespace App\Repository;

use App\Entity\UserTextbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserTextbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTextbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTextbook[]    findAll()
 * @method UserTextbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTextbookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserTextbook::class);
    }

    // /**
    //  * @return UserTextbook[] Returns an array of UserTextbook objects
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
    public function findOneBySomeField($value): ?UserTextbook
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
