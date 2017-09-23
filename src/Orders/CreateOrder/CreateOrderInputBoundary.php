<?php

namespace Acme\Market\Orders\CreateOrder;

interface CreateOrderInputBoundary
{
    public function handle(CreateOrderRequest $request): CreateOrderResponse;
}
