<?php

namespace Tests\Orders\CreateOrder;

use Tests\TestCase;
use Acme\Market\Orders\CreateOrder\CreateOrderRequest;

class CreateOrderRequestTest extends TestCase
{
    function testRequestFields()
    {
        $request = new CreateOrderRequest(
            $productId = uniqid(),
            $customerId = uniqid(),
            $quantity = 1
        );

        $this->assertEquals($productId, $request->getProductId());
        $this->assertEquals($customerId, $request->getCustomerId());
        $this->assertEquals($quantity, $request->getQuantity());
    }
}
