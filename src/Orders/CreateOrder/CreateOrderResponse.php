<?php

namespace Acme\Market\Orders\CreateOrder;

class CreateOrderResponse
{
    protected $created;

    protected $orderId;

    protected $quantityInStock;

    public function isCreated()
    {
        return $this->created;
    }

    public function setCreated(bool $created)
    {
        $this->created = $created;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getQuantityInStock()
    {
        return $this->quantityInStock;
    }

    public function setQuantityInStock(bool $quantityInStock)
    {
        $this->quantityInStock = $quantityInStock;
    }
}
