<?php

namespace Acme\Market\Orders\CreateOrder;

class CreateOrderRequest
{
    protected $productId;

    protected $customerId;

    protected $quantity;

    public function __construct($productId, $customerId, $quantity)
    {
        $this->productId = $productId;
        $this->customerId = $customerId;
        $this->quantity = $quantity;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
