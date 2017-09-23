<?php

namespace Acme\Market\Products\ShowProduct;

interface ShowProductInputBoundary
{
    public function handle(ShowProductRequest $request): ShowProductResponse;
}
