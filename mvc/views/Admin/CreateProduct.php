<?php 
require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\AdminController.php');
$categories = $data['categories'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Testfreshlead/public/css/createProduct.css?v=<?php echo time();?>">
    <title>Document</title>
</head>
<body>
    
        <div class="back">
            
            <a href="/Testfreshlead/Admin/ProductManager"><button><i class="fa fa-angle-double-left" style="font-size:30px"></i>Back</button></a>
        </div>
        <form action="" method="POST">
        <h1>Thêm sản phẩm</h1>
            <label for="product_name">Tên sản phẩm:</label>
            <input type="text" name="product_name" id="product_name" required><br>

            <label for="price">Giá:</label>
            <input type="text" name="price" id="price" required><br>

            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" required></textarea><br>

            <label for="unit">Đơn vị:</label>
            <input type="text" name="unit" id="unit"  required><br>

            <label for="unit">Số lượng:</label>
            <input type="text" name="stock_quantity" id="stock_quantity"  required><br>


            <label for="image">Hình ảnh:</label>
            <input type="text" name="product_image" id="product_image" required><br>

            <label for="category_name">Danh mục:</label>
            <select name="category_id" id="id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id'] ?>">
                        <?php echo $category['category_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Lưu thay đổi</button> 
        </form>
</body>
</html>