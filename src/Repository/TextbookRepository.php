<?php

namespace App\Repository;

use App\Entity\Textbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    public function findAllTextbooks()
    {
        return $this->getOrCreateQueryBuilder()
            ->Select('a.id')
            ->addSelect('a.title, a.author, a.imageFilename')
            ->getQuery()
            ->getResult();
    }

    //TODO to remove
//    public function findAllChapterForBook($slug)
//    {
//        return $this->getOrCreateQueryBuilder()
//            ->leftJoin('a.chapters', 'c')
//            ->select('c.title')
//            ->andWhere('a.slug = :slug')
//            ->setParameter('slug', $slug)
//            ->getQuery()
//            ->getResult();
//    }

    public function findAllBooksForCategory($id)
    {
        return $this->getOrCreateQueryBuilder()
            ->leftJoin('a.image', 'i')
            ->select('a.title, a.authors, a.slug, a.editor')
            ->addSelect('CONCAT(i.path, i.name) AS path')
            ->andWhere('a.category = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
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
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null) {
        return $qb ?: $this->createQueryBuilder('a');
    }
}
