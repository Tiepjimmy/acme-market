<?php

namespace Acme\Market\Orders\CreateOrder;

use Acme\Market\Orders\Order;
use Acme\Market\Orders\OrdersGateway;
use Acme\Market\Products\ProductNotFoundException;
use Acme\Market\Products\ProductsGateway;

class CreateOrder implements CreateOrderInputBoundary
{
    /** @var ProductsGateway */
    protected $products;

    /** @var OrdersGateway */
    protected $orders;

    public function __construct(ProductsGateway $products, OrdersGateway $orders)
    {
        $this->products = $products;
        $this->orders = $orders;
    }

    public function handle(CreateOrderRequest $request): CreateOrderResponse
    {
        $response = new CreateOrderResponse();

        try {
            $product = $this->products->find(
                $request->getProductId()
            );
        } catch (ProductNotFoundException $e) {
            $response->setCreated(false);
            $response->setOrderId(null);
            $response->setQuantityInStock(false);

            return $response;
        }

        if ($product->stock() < $request->getQuantity()) {
            $response->setCreated(false);
            $response->setOrderId(null);
            $response->setQuantityInStock(false);

            return $response;
        }

        $response->setQuantityInStock(true);

        $order = new Order();
        $order->setProductId($request->getProductId());
        $order->setCustomerId($request->getCustomerId());
        $order->setQuantity($request->getQuantity());

        $order = $this->orders->save($order);

        $response->setOrderId($order->id());
        $response->setCreated(true);

        return $response;
    }
}
