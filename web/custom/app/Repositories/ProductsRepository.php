<?php

namespace App\Repositories;

use Acme\Market\Products\Product;
use Acme\Market\Products\ProductNotFoundException;
use Acme\Market\Products\ProductsGateway;

class ProductsRepository implements ProductsGateway
{
    public function find($id): Product
    {
        if (! in_array($id, [ 123, 456])) {
            throw new ProductNotFoundException();
        }

        $product = new Product();
        $product->setId($id);
        $product->setStock(10);

        return $product;
    }

    public function all($page, $perPage): array
    {
        $product1 = new Product();
        $product1->setId(123);
        $product1->setStock(10);

        $product2 = new Product();
        $product2->setId(456);
        $product2->setStock(10);

        return [
            $product1, $product2
        ];
    }
}
