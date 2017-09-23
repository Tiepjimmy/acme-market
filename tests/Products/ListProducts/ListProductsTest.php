<?php

namespace Tests\Products\ListProducts;

use Acme\Market\Products\ListProducts\ListProducts;
use Acme\Market\Products\ListProducts\ListProductsRequest;
use Acme\Market\Products\ListProducts\ListProductsResponse;
use Acme\Market\Products\Product;
use Acme\Market\Products\ProductsGateway;
use Tests\TestCase;

class ListProductsTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->products = $this->mock(ProductsGateway::class);
        $this->useCase = new ListProducts(
            $this->products
        );
    }

    function testEmptyResponse()
    {
        $this->products
            ->expects($this->once())
            ->method('all')
            ->with($page = 2, $perPage = 20)
            ->willReturn([]);

        $request = new ListProductsRequest($page, $perPage);

        /** @var ListProductsResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(ListProductsResponse::class, $response);
        $this->assertEmpty($response->getProducts());
    }

    function testProductsResponse()
    {
        $this->products
            ->expects($this->once())
            ->method('all')
            ->with($page = 2, $perPage = 20)
            ->willReturn([
                $this->mock(Product::class),
                $this->mock(Product::class),
                $this->mock(Product::class),
            ]);

        $request = new ListProductsRequest($page, $perPage);

        /** @var ListProductsResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(ListProductsResponse::class, $response);
        $this->assertNotEmpty($response->getProducts());
        $this->assertCount(3, $response->getProducts());
    }
}
