<?php

namespace Acme\Market\Products\ListProducts;

class ListProductsRequest
{
    protected $page;

    protected $perPage;

    public function __construct($page = 1, $perPage = 12)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
