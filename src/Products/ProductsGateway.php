<?php

namespace Acme\Market\Products;

interface ProductsGateway
{
    public function find($id): Product;
}
