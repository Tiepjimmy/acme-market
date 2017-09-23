<?php

namespace Tests\Orderds;

use Acme\Market\Orders\Order;

class OrderTest extends \Tests\TestCase
{
    function testFields()
    {
        $order = new Order();

        $order->setId($id = uniqid());
        $order->setCustomerId($customerId = uniqid());
        $order->setProductId($productId = uniqid());
        $order->setQuantity($quantity = rand(0, 1000));

        $this->assertEquals($id, $order->id());
        $this->assertEquals($customerId, $order->customerId());
        $this->assertEquals($productId, $order->productId());
        $this->assertEquals($quantity, $order->quantity());
    }
}
