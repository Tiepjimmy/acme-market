<?php

namespace Tests\Products\ListProducts;

use Acme\Market\Products\Product;
use Acme\Market\Products\ShowProduct\ShowProductResponse;
use Tests\TestCase;

class ShowProductResponseTest extends TestCase
{
    function testRequestFields()
    {
        $response = new ShowProductResponse();

        $response->setFound($found = true);
        $response->setProduct(
            $product = $this->mock(Product::class)
        );

        $this->assertTrue($response->isFound());
        $this->assertEquals($product, $response->getProduct());
    }
}
