<?php

namespace Acme\Market\Products\ShowProduct;

use Acme\Market\Products\Product;

class ShowProductResponse
{
    /** @var boolean */
    protected $found = false;

    /** @var Product */
    protected $product = null;

    public function isFound(): bool
    {
        return $this->found;
    }

    public function setFound(bool $found)
    {
        $this->found = $found;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product)
    {
        $this->product = $product;
    }
}
