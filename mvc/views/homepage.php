<?php
    require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\ProductController.php');
    $bestSaleProduct = $data['bestSaleProduct'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../../Testfreshlead/public/css/homepage.css?v=<?php echo time(); ?>">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=ABeeZee:ital@0;1&family=Calistoga&family=Cormorant+Upright:wght@300;400;500;600;700&family=Epilogue:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <header><?php include('C:/xampp/htdocs/Testfreshlead/mvc/views/layout/header.php') ?></header>

    <div class="banner-homepage">
        <div class="banner-homepage-container">
            <img class="main-img" src="../../Testfreshlead/Public/images/banner-homepage.jpg" alt="banner-homepage-img">
            <img class="extra-img" src="../../Testfreshlead/Public/images/raucuqua.png" alt="raucuqua-img">
            <h2>WELCOME TO FRESHLEAF</h2> 
            <h1>Choose clean, <br>Life healthy</h1>
        </div>
    </div>

    <div class="discount-homepage">
        <div class="discount-homepage-container">
            <div id="discount-small1" class="discount-small">
                <div class="half-circle-left"></div>
                <h1>#ABCDEF</h1>
                <p>Bills over 50.000đ</p>
                <h2>#ABCDEF</h2>
                <button>Save</button>
                <div class="half-circle-right"></div>
            </div>
            <div id="discount-small2" class="discount-small">
                <div class="half-circle-left"></div>
                <h1>#ABCDEF</h1>
                <p>Bills over 50.000đ</p>
                <h2>#ABCDEF</h2>
                <button>Save</button>
                <div class="half-circle-right"></div>
            </div>
            <div id="discount-small3" class="discount-small">
                <div class="half-circle-left"></div>
                <h1>#ABCDEF</h1>
                <p>Bills over 50.000đ</p>
                <h2>#ABCDEF</h2>
                <button>Save</button>
                <div class="half-circle-right"></div>
            </div>
            <div id="discount-small4" class="discount-small">
                <div class="half-circle-left"></div>
                <h1>#ABCDEF</h1>
                <p>Bills over 50.000đ</p>
                <h2>#ABCDEF</h2>
                <button>Save</button>
                <div class="half-circle-right"></div>
            </div>
        </div>
    </div>

    <div class="bestSale-product-homepage">
        <div class="bestSale-product-container">
            <div class="title-bestSale">
                <h1>Hot Selling Products</h1>
                <a href="#">Show all product <ion-icon name="arrow-forward-outline"></ion-icon></a>
            </div>

            <div class="bestSale-detail">
                <?php foreach ($bestSaleProduct as $product): ?>
                    <a href="/Testfreshlead/Product/detail/<?php echo htmlspecialchars($product['product_id']); ?>" class="product-card">
                        <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                        <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                        <span class="label">Bán chạy</span>
                        <div>
                            <p class="price"><?php echo htmlspecialchars($product['price']); ?>đ</p>
                            <button class="add-button">+</button>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <div class="brand-banner-homepage">
        <div class="brand-banner-container">
            <div class="big-line-brand">
                <div class="repeat-brand">
                    <img class="brand-img" src="../../Testfreshlead/public/images/brand-img.png" alt="">
                    <h5>Freshleaf</h5>
                </div>

                <div class="repeat-brand">
                    <img class="brand-img" src="../../Testfreshlead/public/images/brand-img.png" alt="">
                    <h5>Freshleaf</h5>
                </div>

                <div class="repeat-brand">
                    <img class="brand-img" src="../../Testfreshlead/public/images/brand-img.png" alt="">
                    <h5>Freshleaf</h5>
                </div>

                <div class="repeat-brand">
                    <img class="brand-img" src="../../Testfreshlead/public/images/brand-img.png" alt="">
                    <h5>Freshleaf</h5>
                </div>

                <div class="repeat-brand">
                    <img class="brand-img" src="../../Testfreshlead/public/images/brand-img.png" alt="">
                    <h5>Freshleaf</h5>
                </div>
            </div>
            <div class="small-line-brand"></div>
            <img class="other-brandWebsite" src="../../Testfreshlead/public/images/raucuqua1.png" alt="">
        </div>
    </div>

    <div class="advertise-homepage">
        <div class="advertise-container">
            <h2>Ưu đãi <span>giảm giá</span> đến 50%</h2>
            <h1>Tài khoản mới</h1>
            <div id="voucher">
                <i class="fa-solid fa-ticket-simple"></i>
                <span>Vô vàn khuyến mãi</span>
            </div>
            <div id="product">
                <!-- <i class="fa-solid fa-lemon"></i> -->
                <span>Đa dạng sản phẩm</span>
            </div>
            <div id="customer">
                <!-- <i class="fa-solid fa-user"></i> -->
                <span>Khách hàng tin tưởng</span>
            </div>
            <img class="advertise-homepage-img" src="../../Testfreshlead/public/images/advertise.png" alt="">
        </div>
    </div>

    <footer><?php include('C:/xampp/htdocs/Testfreshlead/mvc/views/layout/footer.php')?></footer>
</body>
</html>