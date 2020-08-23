<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker\Factory;
class ProductFixtures extends Fixture
{



    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $name = [
            'Umbrella',
            'Hat',
            'Shorts',
            'Jacket',
            'Coat',
            'Raincoat',
            'T-Shirt'
        ];
    
        $short = [
            'UM',
            'HAT',
            'ST',
            'JT',
            'CT',
            'RCT',
            'TSH'
        ];
        
        for ($i = 0; $i < 50; $i++) {
            $Product = new Product();
            $productName = $faker->randomElement($name);
            $Product->setSku($short[array_search($productName,$name,true)]);
            $Product->setName($productName);
            $Product->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 150));
            $manager->persist($Product);
        }


        $manager->flush();
    }
}
