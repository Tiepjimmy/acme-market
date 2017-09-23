<?php

use Acme\Market\Products\ShowProduct\ShowProduct;
use Acme\Market\Products\ShowProduct\ShowProductRequest;
use App\Repositories\ProductsRepository;

if (! isset($_GET['id']) || ! is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

require __DIR__.'/vendor/autoload.php';

$products = new ProductsRepository();
$useCase = new ShowProduct(
    $products
);

$request = new ShowProductRequest($id = $_GET['id']);
$response = $useCase->handle($request);
$product = $response->getProduct();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Product - <?=$id;?></title>
</head>
<body>
<?php if ($response->isFound()) : ?>
    <h1>Product <?=$id;?></h1>
    <p><?=$product->stock();?> in stock.</p>
    <a href="order.php?id=<?=$id;?>">Order</a>
<?php else: ?>
    <p>Product not found.</p>
<?php endif; ?>
<a href="index.php">Return to main page</a>
</body>
</html>
