<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Model\ProductResult;


class RecommendedProductsController extends AbstractController

{
/*
* Lists Recommended Products in a city based on it's weather
* @Route("/api/products/recommended/{city}", name="RecommendedProducts")
* @return JsonResponse
*/
  
    public function getRecommendedProduct($city, ProductRepository $productRepository)
    {
        $forecast = $this->getWeatherForCity($city);
        $products=$productRepository->findByAppropirateWeather($forecast['conditionCode'], $forecast['temperature']); 
        $productResult = new ProductResult();
        $productResult->setCity($city);
        $productResult->setForecast([$forecast['conditionCode'],$forecast['temperature']]);
        $productResult->setRecommendedProducts($products);
        return $this->json($productResult);
    }
    /*
    Uses the MeteoAPI to get forecasts for the chosen $city - from url using GET method
    */
    public function getWeatherForCity($city)
    {
        $url = "https://api.meteo.lt/v1/places/$city/forecasts/long-term";
        $content = @file_get_contents($url);
        if (false === $content) {
            throw $this->createNotFoundException('No such city found, try using https://weatherella.herokuapp.com//api/products/recommended/{city}');
        }
        $allWeather = json_decode($content,true);
        return $this->getCurrentWeather($allWeather);
    }

    /*
        Gets the current forecast based on the current UTC time from the $allWeather array 
    */

    public function getCurrentWeather($allWeather)
    {
        $time = $this->roundHours();
        $theTime = $time->format('Y-m-d H:i:s');
        foreach ($allWeather['forecastTimestamps'] as $forecast) {

            if(str_contains($forecast['forecastTimeUtc'], $theTime))
            {
                $forecast = $this->isItColdOrWarm($forecast);
                return $forecast;
            }
        
        }
    }
    /*
    Adds an attribute to $forecast which determines whether it is cold or warm outside based on temperature
    $forecast - the current forecast from api.meteo.lt
    */
    public function isItColdOrWarm($forecast)
    {
        $arrCold = array('temperature' => 'cold');
        $arrWarm = array('temperature' => 'warm');
        if($forecast['airTemperature'] < 10)
        {
            $forecast = $forecast + $arrCold;
            return $forecast;
        }
        else
        {
            $forecast = $forecast + $arrWarm;
            return $forecast;
        }
    }

    /*
    Rounds to the nearest hour
    */
    function roundHours()
    {
        $date = new \DateTime();
        $minutes = gmdate("i");
        $seconds = gmdate("s");
        $test = "PT{$minutes}M{$seconds}S";
        if ($minutes<30)
        {
            $date->sub(new \DateInterval("$test"));
        }
        else{
            $date->add(new \DateInterval('PT1H'));
            $date->sub(new \DateInterval("PT{$minutes}M{$seconds}S"));
        }
        return $date;

    }


}
