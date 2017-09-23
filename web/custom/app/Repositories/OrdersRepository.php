<?php

namespace App\Repositories;

use Acme\Market\Orders\Order;
use Acme\Market\Orders\OrdersGateway;

class OrdersRepository implements OrdersGateway
{
    public function find($id): Order
    {
        $path = __DIR__.'/../../storage/' . $id . '.json';

        $order = unserialize(file_get_contents($path));

        return $order;
    }

    public function save(Order $order): Order
    {
        $order->setId($id = uniqid());

        $path = __DIR__.'/../../storage/' . $id . '.json';

        file_put_contents($path, serialize($order));

        return $order;
    }
}
