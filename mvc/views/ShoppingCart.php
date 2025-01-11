<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Testfreshlead/public/css/shoppingCart.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/Testfreshlead/public/css/header.css?v=<?php echo time(); ?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Calistoga&family=Cormorant+Upright:wght@300;400;500;600;700&family=Epilogue:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<body>
    <header><?php include('C:/xampp/htdocs/Testfreshlead/mvc/views/layout/header.php') ?></header>  
    <?php
        $cartItems = $data['cartItems'];
        $totalQuantity = $data['totalQuantity'];
    ?>
    <div class="shopping-cart">
        <?php if (empty($cartItems)): ?>
            <div class="shopping-cart-container2">
                <ion-icon name="cart-outline"></ion-icon>
                <h1>Chưa có sản phẩm nào trong giỏ hàng</h1>
            </div>

            <a href="/Testfreshlead"><button class="backtohome">Quay lại trang chủ</button></a>
        <?php else: ?>
            <div class="shopping-cart-container1">
                <div class="cart-header">
                    <h2>Shopping Cart</h2>
                    <p>( <span><?php echo htmlspecialchars($totalQuantity[0]['total_quantity']);?></span> products )</p>
                </div>  
                
                <div class="cart-title">
                    <h4 class="cart-title1">Product</h4>
                    <h4 class="cart-title2">Unit Price</h4>
                    <h4 class="cart-title3">Quantity</h4>
                    <h4 class="cart-title4">Line Total</h4>
                </div>

                <?php 
                    $totalAmount = 0;
                ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item"> 
                        <button class="delete-cart-item" data-id="<?php echo htmlspecialchars($item['product_id']); ?>">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>

                        <div class="product-info">
                            <img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="Lime">
                            <div>
                                <p><?php echo htmlspecialchars($item['product_name']); ?> ( <span><?php echo htmlspecialchars($item['unit']); ?></span> )</p>
                                <p class="category">Category: <?php echo htmlspecialchars($item['category_name']); ?></p>
                            </div>
                        </div>

                        <div class="unit-price"><?php echo htmlspecialchars($item['price']); ?></div>

                        <div class="quantity">
                            <button class="quantity-btn decrease" data-id="<?php echo htmlspecialchars($item['product_id']); ?>"><ion-icon name="remove-outline"></ion-icon></button>
                            <span class="quantity-value" data-id="<?php echo htmlspecialchars($item['product_id']); ?>"><?php echo htmlspecialchars($item['quantity']); ?></span>
                            <button class="quantity-btn increase" data-id="<?php echo htmlspecialchars($item['product_id']); ?>"><ion-icon name="add-outline"></ion-icon></button>
                        </div>




                        <div class="line-total"><?php echo htmlspecialchars($item['line_total']); ?>đ</div>
                    </div>
                    <?php $totalAmount += htmlspecialchars($item['line_total']);?>
                <?php endforeach; ?>

                <div class="cart-footer">
                    <button onclick="location.href='/Testfreshlead/Order/viewOrderPage'" class="order-btn">Order</button>
                    <p class="total-amount">Total Amount: <span><?php echo $totalAmount?>.000đ</span></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'C:\xampp\htdocs\Testfreshlead\mvc\views\layout\footer.php' ?>
    
    <script>
        document.querySelectorAll(".quantity-btn").forEach(button => {
            button.addEventListener("click", function () {
                const productId = this.getAttribute("data-id");
                const action = this.classList.contains("increase") ? "increase" : "decrease";

                fetch("/Testfreshlead/ShoppingCart/updateQuantity", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ product_id: productId, action: action })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const quantityElement = document.querySelector(`.quantity-value[data-id="${productId}"]`);
                        quantityElement.innerText = data.new_quantity;

                        const lineTotalElement = quantityElement.closest(".cart-item").querySelector(".line-total");
                        lineTotalElement.innerText = data.line_total + ".000đ";

                        document.querySelector(".total-amount span").innerText = data.total_amount + ".000đ";
                        document.querySelector(".cart-header span").innerText = data.total_quantity;
                    } else { 
                        alert(data.message || "Có lỗi xảy ra!");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });

        //Delete products
        document.querySelectorAll(".delete-cart-item").forEach(button => {
            button.addEventListener("click", function () {
                const productId = this.getAttribute("data-id");

                // Gửi yêu cầu AJAX để xóa sản phẩm khỏi giỏ hàng
                fetch("/Testfreshlead/ShoppingCart/deleteItem", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Xóa sản phẩm khỏi giao diện
                        const cartItem = this.closest(".cart-item");
                        cartItem.remove();

                        // Cập nhật tổng số lượng và tổng tiền
                        document.querySelector(".cart-header span").innerText = data.total_quantity;
                        document.querySelector(".total-amount span").innerText = data.total_amount + ".000đ";
                    } else {
                        alert(data.message || "Có lỗi xảy ra!");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });

    </script>
    
</body>
</html>