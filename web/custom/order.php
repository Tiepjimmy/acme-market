<?php

use Acme\Market\Orders\CreateOrder\CreateOrder;
use Acme\Market\Orders\CreateOrder\CreateOrderRequest;
use App\Repositories\OrdersRepository;
use App\Repositories\ProductsRepository;

if (! isset($_POST['productId']) || ! is_numeric($_POST['productId'])) {
    header("Location: index.php");
    exit;
}

require __DIR__.'/vendor/autoload.php';

$orders = new OrdersRepository();
$products = new ProductsRepository();

$useCase = new CreateOrder(
    $products, $orders
);

$request = new CreateOrderRequest(
    $productId = $_POST['productId'],
    $customerId = uniqid(),
    $quantity = $_POST['quantity'] ?? 1
);

$response = $useCase->handle($request);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Order summary</title>
</head>
<body>
<?php if ($response->isCreated()): ?>
    <h1>Order summary (ID: <?=$response->getOrderId(); ?>)</h1>
<?php else: ?>
    <?php if ( ! $response->isQuantityInStock()): ?>
        <p>Not enough product in stock.</p>
    <?php else: ?>
        <p>We couldn't create an order.</p>
    <?php endif;?>
<?php endif; ?>
<a href="index.php">Return to main page</a>
</body>
</html>
