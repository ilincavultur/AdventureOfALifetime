<?php

namespace App\Repository;

use App\Entity\Adventure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adventure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adventure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adventure[]    findAll()
 * @method Adventure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdventureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adventure::class);
    }

    /**
     * @param null $search
     * @return QueryBuilder
     */
    public function findAdventures($search = null)
    {
        $qb = $this->createQueryBuilder('p');


        if (null !== $search){
            $qb->where('p.Location like :search')
                ->orWhere('p.Date like :search')
                ->orWhere('p.Type like :search')
                ->setParameter('search','%'.$search.'%');
        }

        $qb->orderBy('p.createdAt','DESC');

        return $qb;
    }

    // /**
    //  * @return Adventure[] Returns an array of Adventure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adventure
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
