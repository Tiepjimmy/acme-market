<?php

namespace Tests\Products\ListProducts;

use Acme\Market\Products\ListProducts\ListProductsRequest;
use Tests\TestCase;

class ListProductsRequestTest extends TestCase
{
    function testRequestFields()
    {
        $request = new ListProductsRequest($page = 1, $perPage = 10);

        $this->assertEquals($page, $request->getPage());
        $this->assertEquals($perPage, $request->getPerPage());
    }
}
