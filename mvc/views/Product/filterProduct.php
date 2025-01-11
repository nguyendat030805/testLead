<?php
    require_once('C:/xampp/htdocs/Testfreshlead/mvc/controller/ProductController.php');
    $productsByCategory = $data['productsByCategory']; // Dữ liệu từ Controller
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Testfreshlead/Public/Css/filterProduct.css?v=<?php echo time(); ?>">
    <title>Tất Cả Sản Phẩm</title>
</head>
<body>
<header><?php include('C:/xampp/htdocs/Testfreshlead/mvc/views/layout/header.php') ?></header>

<div class="products">
    <h1>Kết quả lọc</h1>

    <?php if (!empty($productsByCategory)): ?>
        <?php foreach ($productsByCategory as $categoryName => $products): ?>
            <h2><?= htmlspecialchars($categoryName) ?></h2>
            <div class="allProduct">
                <?php foreach ($products as $product): ?>
                    <div class="ListProducts">
                        <a href="/Testfreshlead/Product/detail/<?php echo htmlspecialchars($product['product_id']); ?>" class="product-card">
                            <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">    
                            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3> 
                            <div class="price">
                                <p class="price"><?php echo htmlspecialchars($product['price']); ?>đ</p>
                                <button class="add-button">+</button>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào phù hợp với tiêu chí lọc.</p>
    <?php endif; ?>
</div>

<?php include 'C:/xampp/htdocs/Testfreshlead/mvc/views/layout/footer.php' ?>

</body>
</html>
