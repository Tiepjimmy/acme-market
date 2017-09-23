<?php

namespace Tests\Products\ListProducts;

use Acme\Market\Products\Product;
use Acme\Market\Products\ProductNotFoundException;
use Acme\Market\Products\ProductsGateway;
use Acme\Market\Products\ShowProduct\ShowProduct;
use Acme\Market\Products\ShowProduct\ShowProductRequest;
use Acme\Market\Products\ShowProduct\ShowProductResponse;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->products = $this->mock(ProductsGateway::class);
        $this->useCase = new ShowProduct(
            $this->products
        );
    }

    function testProductNotFound()
    {
        $this->products
            ->expects($this->once())
            ->method('find')
            ->with($id = uniqid())
            ->willThrowException(new ProductNotFoundException());

        $request = new ShowProductRequest($id);

        /** @var ShowProductResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(ShowProductResponse::class, $response);
        $this->assertFalse($response->isFound());
        $this->assertNull($response->getProduct());
    }

    function testProductFound()
    {
        $this->products
            ->expects($this->once())
            ->method('find')
            ->with($id = uniqid())
            ->willReturn($product = $this->mock(Product::class));

        $request = new ShowProductRequest($id);

        /** @var ShowProductResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(ShowProductResponse::class, $response);
        $this->assertTrue($response->isFound());
        $this->assertEquals($product, $response->getProduct());
    }
}
