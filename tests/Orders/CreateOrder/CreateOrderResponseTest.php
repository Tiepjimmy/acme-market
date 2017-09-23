<?php

namespace Tests\Orders\CreateOrder;

use Tests\TestCase;
use Acme\Market\Orders\CreateOrder\CreateOrderResponse;

class CreateOrderResponseTest extends TestCase
{
    function testResponseFields()
    {
        $response = new CreateOrderResponse();

        $response->setCreated($created = true);
        $response->setOrderId($orderId = uniqid());
        $response->setQuantityInStock($quantityInStock = true);

        $this->assertEquals($created, $response->isCreated());
        $this->assertEquals($orderId, $response->getOrderId());
        $this->assertEquals($quantityInStock, $response->isQuantityInStock());
    }
}
