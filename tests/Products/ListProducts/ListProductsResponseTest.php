<?php

namespace Tests\Products\ListProducts;

use Acme\Market\Products\ListProducts\ListProductsResponse;
use Acme\Market\Products\Product;
use Tests\TestCase;

class ListProductsResponseTest extends TestCase
{
    function testRequestFields()
    {
        $response = new ListProductsResponse();

        $products = [
            $this->mock(Product::class),
            $this->mock(Product::class),
            $this->mock(Product::class),
        ];

        $response->setProducts($products);

        $this->assertEquals($products, $response->getProducts());
        $this->assertCount(3, $response->getProducts());
    }
}
