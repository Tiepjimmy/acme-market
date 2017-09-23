<?php

namespace Acme\Market\Orders;

interface OrdersGateway
{
    public function find($id): Order;

    public function save(Order $order): Order;
}
