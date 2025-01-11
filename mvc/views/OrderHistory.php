<?php
session_start();
require_once 'C:\xampp\htdocs\Testfreshlead\mvc\controller\OrderHistoryController.php';
if (!empty($_SESSION['alert'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['alert']) . "');</script>";
    unset($_SESSION['alert']); // Xóa thông báo sau khi hiển thị
}

$categories = $data['orders'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="/Testfreshlead/public/css/header.css?v=<?php echo time(); ?>">
    <style>
        .history_container {
            margin-top: 42px;
            padding: 20px;
        }
        .order {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }
        .order-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .order-titles {
            display: flex;
            font-weight: bold;
            margin-bottom: 8px;
            /* gap: 55px; */
        }
        .order-titles div {
            /* flex: 1; */
            margin-right: 90px;
            margin-left: 90px;
            text-align: center;
        }
        .order-product {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 8px;
        }
        .product_rating a{
            font-size: 25px;
            text-decoration: none;
        }
        .order-product img {
            max-width: 100px;
            height: auto;
        }
        .order-product div {
            flex: 1;
            text-align: center;
        }
        .order-total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php require 'C:\xampp\htdocs\Testfreshlead\mvc\views\layout\header.php'?>
    <div class="history_container">
        <h1>Order History</h1>
        <?php if (!empty($categories)): ?>
            <?php 
            ?>
            <?php foreach ($categories as $orderId => $orderDetails): ?>
                <div class="order">
                    <div class="order-titles">
                        <div>Image</div>
                        <div>Product Name</div>
                        <div>Price</div>
                        <div>Quantity</div>
                        <div>Total</div>
                    </div>
                    <?php $orderTotal = 0; ?>
                    <?php foreach ($orderDetails['details'] as $index=>$detail): ?>
                        <?php
                            $lineTotal = $detail['price'] * $detail['quantity'];
                            $orderTotal += $lineTotal;
                        ?>
                        <div class="order-product">
                            <div><img src="<?php echo $detail['product_image']; ?>" alt="Product Image"></div>
                            <div><?php echo $detail['product_name']; ?></div>
                            <div><?php echo number_format($detail['price'], 2); ?> đ</div>
                            <div><?php echo $detail['quantity']; ?></div>
                            <div><?php echo number_format($detail['price'] * $detail['quantity'], 2); ?> đ</div>

                            <div class="product_rating">
                                <a href="/Testfreshlead/Review/addReview?order_id=<?php echo $orderId; ?>&product_id=<?php echo $detail['product_id']; ?>">&#9998;</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="order-total">
                        Total for Order: <?php echo number_format($orderTotal, 2); ?> đ

                    <div class="order_rating">
                        <a href="/Testfreshlead/Review/addReview?order_id=<?php echo $orderId; ?>&review_type=all_products">Rate entire order</a>
                    </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
