<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CityListController extends AbstractController
{
    /**
     * @Route("/city/list", name="city_list")
     * Provides a list of cities
     */

    public function index()
    {
        
        return $this->render('city_list/index.html.twig', [
            'controller_name' => 'CityListController',
            'cities' => $this->getCities()
        ]);
    }
    /**
     * Returns a list of cieties
     */
    public function getCities()
    {
        $url = "https://api.meteo.lt/v1/places/";
        $content = @file_get_contents($url);
        if (false === $content) {
            throw $this->createNotFoundException('No such cities found');
        }
        $allCities = json_decode($content,true);
        return ($allCities);
    }

}
