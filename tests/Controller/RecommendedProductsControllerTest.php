<?
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecommendedProductsControllerTest extends WebTestCase
{
    public function testShowProducts()
    {
        $client = static::createClient();

        $client->request('GET', '/api/products/recommended/vilnius');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
    }
}