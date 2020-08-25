<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }
    /*
    Queries the database appropriate_Weather column, returns products where $sky and $temperatures match in the row.
    Temperature simplified to warm/cold, sky conditions are returned by the api.
    */
    public function findByAppropirateWeather($sky, $temperature)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT sku, name, price FROM product p
            WHERE p.appropriate_Weather LIKE '%$sky%'
            AND p.appropriate_Weather LIKE '%$temperature%'
            ORDER BY RANDOM()
            LIMIT 5
            ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetchAll();

    }

}
