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
        //$sampleData[element][n] possible values for n:  0 = name, 1 shortend for generating barcode(sku) , 2 applicable for weather
        $sameplData = [
            ['Umbrella', 'UM', 'light-rain, moderate-rain, heavy-rain, sleet, cold, warm'],
            ['Hat','HAT','light-rain, clear, moderate-rain, heavy-rain, sleet, light-snow, moderate-snow, heavy-snow, isolated-clouds, cold, fog'],
            ['Bonnet', 'BON','clear, warm, isolated-clouds, light-rain'],
            ['Shorts','ST','warm, clear, isolated-clouds, scattered-clouds, overcast, fog'],
            ['Jacket','JT','cold, clear, isolated-clouds, scattered-clouds, overcast, fog, light-rain'],
            ['Coat','CT','cold, clear, isolated-clouds, scattered-clouds, overcast, light-snow, moderate-snow, heavy-snow, light-rain, moderate-rain'],
            ['Raincoat','RCT','cold, warm, light-rain, moderate-rain, heavy-rain'],
            ['T-Shirt', 'TSH','warm, clear, isolated-clouds, scattered-clouds, overcast, fog']
        ];
       
        for ($i = 0; $i < 50; $i++) {
            $Product = new Product();
            $dataIndex = $faker->numberBetween($min = 0, $max = count($sameplData)-1);
            $productName = $this->appendStrings($sameplData[$dataIndex][0], $faker->colorName());
            $sku = $this->formSKU($sameplData[$dataIndex][1], $faker->unique()->numberBetween($min = 0, $max = 150));
            $Product->setSku($sku);
            $Product->setName($productName);
            $Product->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 150));
            $Product->setAppropriateWeather($sameplData[$dataIndex][2]);
            $manager->persist($Product);
        }


        $manager->flush();
    }
    /*
    forms a sku using 2 strings 
    */
    function formSKU ($str1, $str2) { 

        $str1 .='-';
        $str1 .=$str2; 
        
        return $str1; 
    } 
    /*
    appends 2 strings 
    */
    function appendStrings ($str1, $str2) { 

        $str1 .=' ';
        $str1 .=$str2; 
        
        return $str1; 
    } 

      
}
