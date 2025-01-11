<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="/Testfreshlead/public/css/order.css?v=<?php echo time();?>">
    <script src="/Testfreshlead/public/js/order.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Calistoga&family=Cormorant+Upright:wght@300;400;500;600;700&family=Epilogue:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <header><?php include('C:/xampp/htdocs/Testfreshlead/mvc/views/layout/header.php') ?></header>

    <div class="payment">
        <div class="payment-container">
        <div class="purchased-items">
            <h1>Purchased Items</h1>
            <div class="underline"></div>

            <?php
                $cartItems = $data['cartItems'];
                $totalAmount = 0;
            ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="items-detail">
                    <img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="">
                    <div class="item-info">
                        <div>
                            <h5><?php echo htmlspecialchars($item['product_name']); ?> <span>(<?php echo htmlspecialchars($item['unit']); ?>)</span></h5>
                            <p class="item-price"><?php echo htmlspecialchars($item['line_total']); ?>đ</p>
                        </div>
                        <p class="item-category">Category: <?php echo htmlspecialchars($item['category_name']); ?></p>
                        <p class="item-quantity">Số lượng: <?php echo htmlspecialchars($item['quantity']); ?></p>
                    </div>
                </div>
                <?php $totalAmount += htmlspecialchars($item['line_total']);?>
            <?php endforeach; ?>

            <div class="subtotal">
                <h3>Subtotal</h3>
                <span><?php echo $totalAmount; ?>.000đ</span>
            </div>
            <div class="shipping-fee">
                <h3>Shipping Fee</h3>
                <span>30.000đ</span>
            </div>
            <div class="total">
                <h2>Total</h2>
                <span><?php echo $totalAmount + 30; ?>.000đ</span>
            </div>
            <button id="pay-now" onclick="submitOrder()">Pay Now</button>
        </div>


            <div class="payment-info">
                <form action="" method="POST">
                    <h1>Payment Information</h1>
                    <div class="infor-personal">
                        <label>Full name <span class="required">*</span></label>
                        <input type="text" placeholder="Enter your full name">
                    </div>
                    <div class="infor-personal">
                        <label>Email <span class="required">*</span></label>
                        <input type="text" placeholder="Enter your email">
                    </div>
                    <div class="infor-personal">
                        <label>Phone <span class="required">*</span></label>
                        <input type="text" placeholder="Enter your phone number">
                    </div>
                    <div class="infor-personal">
                        <label>Note (Option)</label>
                        <input type="text" placeholder="Enter the note">
                    </div>
                    <div class="infor-personal">
                        <label>Provice / City <span class="required">*</span></label>
                        <input type="text" placeholder="Enter your provice / City">
                    </div>
                    <div class="infor-personal">
                        <label>Address <span class="required">*</span></label>
                        <input type="text" placeholder="Enter your address">
                    </div>

                    <!-- <div class="different-info">
                        <h3>Ship to a different address</h3>
                        <label><input type="radio" name="choice" value="yes">Yes</label>
                        <label><input type="radio" name="choice" value="no">No</label>
                    </div>
                    
                    <h1>Payment Method</h1>
                    <div class="option-method">
                        <a href="#">
                            <img src="/Testfreshlead/public/images/ATM.jpg" alt="">
                            <p>Bank Transfer</p>
                        </a>
                        <a href="#">
                            <img src="/Testfreshlead/public/images/coin.jpg" alt="">
                            <p>Cash on Delivery</p>
                        </a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <?php include 'C:\xampp\htdocs\Testfreshlead\mvc\views\layout\footer.php' ?>
</body>
</html>