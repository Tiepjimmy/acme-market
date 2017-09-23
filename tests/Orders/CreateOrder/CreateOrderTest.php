<?php

namespace Tests\Orders\CreateOrder;

use Acme\Market\Orders\CreateOrder\CreateOrder;
use Acme\Market\Orders\CreateOrder\CreateOrderRequest;
use Acme\Market\Orders\CreateOrder\CreateOrderResponse;
use Acme\Market\Orders\Order;
use Acme\Market\Orders\OrdersGateway;
use Acme\Market\Products\Product;
use Acme\Market\Products\ProductNotFoundException;
use Acme\Market\Products\ProductsGateway;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->products = $this->mock(ProductsGateway::class);
        $this->orders = $this->mock(OrdersGateway::class);

        $this->useCase = new CreateOrder(
            $this->products,
            $this->orders
        );
    }

    function testWhenProductIsNotFound()
    {
        $this->products
            ->expects($this->once())
            ->method('find')
            ->with($id = uniqid())
            ->willThrowException(new ProductNotFoundException());

        $request = new CreateOrderRequest(
            $productId = $id,
            $customerId = uniqid(),
            $quantity = 1
        );

        /** @var CreateOrderResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(CreateOrderResponse::class, $response);
        $this->assertEquals(false, $response->isCreated());
        $this->assertEquals(null, $response->getOrderId());
        $this->assertEquals(false, $response->getQuantityInStock());
    }

    function testWhenQuantityIsTooLow()
    {
        $product = $this->mock(Product::class);

        $product->expects($this->once())
            ->method('stock')
            ->willReturn(1);

        $this->products
            ->expects($this->once())
            ->method('find')
            ->with($id = uniqid())
            ->willReturn($product);

        $request = new CreateOrderRequest(
            $productId = $id,
            $customerId = uniqid(),
            $quantity = 3
        );

        /** @var CreateOrderResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(CreateOrderResponse::class, $response);
        $this->assertEquals(false, $response->isCreated());
        $this->assertEquals(null, $response->getOrderId());
        $this->assertEquals(false, $response->getQuantityInStock());
    }

    function testOrderIsCreated()
    {
        $product = $this->mock(Product::class);
        $order = $this->mock(Order::class);

        $product->expects($this->once())
            ->method('stock')
            ->willReturn(10);

        $order->expects($this->once())
            ->method('id')
            ->willReturn($orderId = uniqid());

        $this->products
            ->expects($this->once())
            ->method('find')
            ->with($id = uniqid())
            ->willReturn($product);

        $this->orders
            ->expects($this->once())
            ->method('save')
            ->willReturn($order);

        $request = new CreateOrderRequest(
            $productId = $id,
            $customerId = uniqid(),
            $quantity = 3
        );

        /** @var CreateOrderResponse $response */
        $response = $this->useCase->handle($request);

        $this->assertInstanceOf(CreateOrderResponse::class, $response);
        $this->assertEquals(true, $response->isCreated());
        $this->assertEquals($orderId, $response->getOrderId());
        $this->assertEquals(true, $response->getQuantityInStock());
    }
}
