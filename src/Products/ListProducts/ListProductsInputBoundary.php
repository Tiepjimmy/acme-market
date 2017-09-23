<?php

namespace Acme\Market\Products\ListProducts;

interface ListProductsInputBoundary
{
    public function handle(ListProductsRequest $request): ListProductsResponse;
}
