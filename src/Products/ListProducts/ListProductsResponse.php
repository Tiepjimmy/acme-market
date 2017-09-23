<?php

namespace Acme\Market\Products\ListProducts;

class ListProductsResponse
{
    protected $products = [];

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products)
    {
        $this->products = $products;
    }
}
