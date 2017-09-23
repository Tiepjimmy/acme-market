<?php

namespace Tests\Products\ListProducts;

use Acme\Market\Products\ShowProduct\ShowProductRequest;
use Tests\TestCase;

class ShowProductRequestTest extends TestCase
{
    function testRequestFields()
    {
        $request = new ShowProductRequest($id = uniqid());

        $this->assertEquals($id, $request->getId());
    }
}
