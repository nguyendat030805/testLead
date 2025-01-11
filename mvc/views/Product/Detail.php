<?php
    require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\ProductController.php');
    $product = $data['product'];
    $relatedProducts = $data['categories'];
    $reviews = $data['reviews'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="/Testfreshlead/public/css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../public/css/detail.css?v=<?php echo time();?>">
</head>

<body>
    <header><?php include('C:/xampp/htdocs/Testfreshlead/mvc/views/layout/header.php') ?></header>  
       
    <div class="product-detail-container">
        <div class="product-detail">
            <img class="product-image" src="<?php echo htmlspecialchars($product['product_image']) ?>" alt="Cải Thìa">

            <div class="product-content">
                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <p class="category">Category: Vegetable</p>
                <div class="underline"></div>
                
                <p class="price"><?php echo htmlspecialchars($product['price']) ?>đ</p>
                <h4>Details Description</h4>
                <p class="description"><?php echo htmlspecialchars($product['description']) ?></p>
            
                <div class="quantity">Số lượng:
                    <button type="button" class="quantity-btn decrease">-</button>
                    <span class="quantity-value" data-price="30">1</span>
                    <button type="button" class="quantity-btn increase">+</button>
                </div>

                <div class="options">
                    <button class="buynow">Thanh toán</button>
                    <button class="addproduct" data-id="<?php echo $product['product_id']; ?>">Thêm vào giỏ hàng</button>
                </div>
            </div>
            <script>
                document.querySelector(".addproduct").addEventListener("click", function () {
                    const productId = this.getAttribute("data-id");
                    const quantity = parseInt(document.querySelector(".quantity-value").innerText);
                    fetch("/Testfreshlead/ShoppingCart/addToCart", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ product_id: productId, quantity: quantity })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Sản phẩm đã được thêm vào giỏ hàng!");
                        } else {
                            alert("Có lỗi xảy ra, vui lòng thử lại.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
            </script>

        </div>

        <!-- Phần sản phẩm liên quan -->
        <h3 class="related-title">Similar Products</h3>
        <div class="related-products">
            <?php foreach ($relatedProducts as $product): ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                <p><?php echo htmlspecialchars($product['product_name']); ?></p>
                <div class="same-product">
                    <p class="price"><?php echo htmlspecialchars($product['price']); ?>đ</p>
                    <button><a href="<?php echo htmlspecialchars($product['product_id']) ?>">Chi tiết</a></button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="review">
            <h2>Review Product</h2>

            <?php if (empty($reviews)) : ?>
                <p class="inform">Chưa có đánh giá nào cho sản phẩm này.</p>
            <?php else : ?>
                <ul>
                    
                    <?php foreach ($reviews as $review) : ?>
                        <li>
                            <p class="rating">
                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                    <span>&#9733;</span>
                                <?php endfor; ?>
                                <?php for ($i = $review['rating']; $i < 5; $i++): ?>
                                    <span>&#9734;</span> 
                                <?php endfor; ?>
                            </p>
                            <p><em><?php echo $review['review_date']; ?></em></p>
                            <p><?php echo htmlspecialchars($review['comment']); ?></p>
                            
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        

    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   -->
    <script src="\Testfreshlead\public\js\detail.js"></script>
    <?php include 'C:\xampp\htdocs\Testfreshlead\mvc\views\layout\footer.php' ?>
</body>
</html>
