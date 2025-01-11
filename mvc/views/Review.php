<?php require_once 'C:\xampp\htdocs\Testfreshlead\mvc\controller\ReviewController.php';
$isOrderReview = $data['orderProduct'] ?? [];
$userId = $data['user_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <style>
        .product-review {
            font-family: Arial, sans-serif;
            margin-top: 70px;
            padding: 10px;
        }

        .product-review #product-list {
            margin-top: 40px;
        }
        .product-image {
            width: 100px;
        }

        .stars {
            display: flex;
            direction: row;
            margin-bottom: 10px;
        }

        .star {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: 0,3s;
        }

        .star:hover,
        .star.selected {
            color: gold;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .product button {
            margin-top: 10px;
        }


    </style>
</head>
<body>
<?php require 'C:\xampp\htdocs\Testfreshlead\mvc\views\layout\header.php'?>

<div class="product-review">
    <h2>Product reviews</h2>
        
    <div id="product-list">

        <?php if (!empty($data['orderProduct'])): ?>
            <?php foreach ($data['orderProduct'] as $product): ?>

                <div class="product">
                    <form action="/Testfreshlead/review/addReview" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($data['user_id'] ?? ''); ?>">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($data['order_id'] ?? ''); ?>">
                        <input type="hidden" name="product_id_<?php echo $product['product_id']; ?>" value="<?php echo $product['product_id']; ?>">

                        <div class="order_title"><?php echo htmlspecialchars($product['product_name']); ?></div>
                        <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" class="product-image">
                        <div class="stars" data-product-id="<?php echo $product['product_id']; ?>">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <input type="radio" id="star_<?php echo $product['product_id'] . '_' . $i; ?>" 
                                    name="rating_<?php echo $product['product_id']; ?>" value="<?php echo $i; ?>" hidden>
                                <label for="star_<?php echo $product['product_id'] . '_' . $i; ?>" class="star">&#9733;</label>
                            <?php endfor; ?>
                        </div>

                        <label for="comment_<?php echo $product['product_id']; ?>">Comment:</label>
                        <textarea name="comment_<?php echo $product['product_id']; ?>" placeholder="Review product..." required></textarea>
                        <!-- Nút gửi đánh giá riêng cho từng sản phẩm -->
                        <button type="submit" name="product_id" value="<?php echo $product['product_id']; ?>" name="review_type" >Send comment</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào để hiển thị!</p>
        <?php endif; ?>
    </div>   
</div>
<script src="\Testfreshlead\Public\js\review.js"></script>
</body>
</html>