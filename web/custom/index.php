<?php

use Acme\Market\Products\ListProducts\ListProducts;
use Acme\Market\Products\ListProducts\ListProductsRequest;
use App\Repositories\ProductsRepository;

require __DIR__.'/vendor/autoload.php';

$products = new ProductsRepository();
$useCase = new ListProducts(
    $products
);

$request = new ListProductsRequest();

$response = $useCase->handle($request);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Acme Market</title>
</head>
<body>
    <h1>All products</h1>
    <ul>
        <?php foreach ($response->getProducts() as $product): ?>
        <li>
            <h3>Product <?=$product->id();?></h3>
            <p>
                <a href="product.php?id=<?=$product->id();?>">Show</a>
            </p>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
