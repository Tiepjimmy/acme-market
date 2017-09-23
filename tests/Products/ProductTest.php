<?php

namespace Tests\Products;

use Acme\Market\Products\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    function testFields()
    {
        $product = new Product();

        $product->setId($id = uniqid());
        $product->setStock($stock = rand(0, 1000));

        $this->assertEquals($id, $product->id());
        $this->assertEquals($stock, $product->stock());
    }
}
