<?php

namespace Acme\Market\Products\ShowProduct;

use Acme\Market\Products\ProductNotFoundException;
use Acme\Market\Products\ProductsGateway;

class ShowProduct implements ShowProductInputBoundary
{
    /** @var ProductsGateway */
    protected $products;

    public function __construct(ProductsGateway $products)
    {
        $this->products = $products;
    }

    public function handle(ShowProductRequest $request): ShowProductResponse
    {
        $response = new ShowProductResponse();

        try {
            $product = $this->products->find(
                $request->getId()
            );

            $response->setFound(true);
            $response->setProduct($product);
        } catch (ProductNotFoundException $e)
        {
            $response->setFound(false);
            $response->setProduct(null);
        }

        return $response;
    }
}
