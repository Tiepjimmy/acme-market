<?php

namespace Acme\Market\Products\ListProducts;

use Acme\Market\Products\ProductsGateway;

class ListProducts implements ListProductsInputBoundary
{
    /** @var ProductsGateway */
    protected $products;

    public function __construct(ProductsGateway $products)
    {
        $this->products = $products;
    }

    public function handle(ListProductsRequest $request): ListProductsResponse
    {
        $response = new ListProductsResponse();

        $response->setProducts(
            $this->products->all(
                $request->getPage(),
                $request->getPerPage()
            )
        );

        return $response;
    }
}
