<?php
namespace App\Model;
/**
 * Used to generate 
 */
class ProductResult
{
    private $city;
    private $forecast;
    private $recommendedProducts;

    // Getters
    public function getCity()
    {
        return $this->city;
    }

    public function getForecast()
    {
        return $this->forecast;
    }

    public function getRecommendedProducts()
    {
        return $this->recommendedProducts;
    }

    // Setters
    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setForecast($forecast)
    {
        $this->forecast = $forecast;
    }

    public function setRecommendedProducts($recommendedProducts)
    {
        $this->recommendedProducts = $recommendedProducts;
    }

}