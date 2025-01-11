<?php
require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\AdminController.php');
$userDetails = $data['userDetails'];
$orders = $data['orders'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Testfreshlead/public/css/userDetail.css?v=<?php echo time();?>">
    <title>Document</title>
</head>
<body>
<div class="back"><a href="/Testfreshlead/Admin/UserManager"><button>Back</button></a></div>
<div class="userDetail">
    
    <div class="profile">
        <div class="infor">
            <img alt="User Avatar" height="50" src="/Public/Image/<?php echo htmlspecialchars($userDetails['avatar']); ?>">
            <h1><?php echo htmlspecialchars($userDetails['user_name']); ?></h1> 
        </div>
        <div class="contact">
            <p>Email: <?php echo htmlspecialchars($userDetails['email']); ?></p> 
            <p>Phone: 0<?php  echo htmlspecialchars($userDetails['phone']); ?></p>
        </div>
        

    </div>
        <div class="product">
            <h1>Những sản phẩm đã mua</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Tổng giá</th>
                        <th>Số lượng</th>
                        <th>Ảnh</th>
                        <th>Thể loại</th>
                        <th>Ngày mua</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?> 
                        <tr>
                            <td><?php echo $order['order_id']; ?></td> 
                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                            <td><?php echo number_format($order['price'] * $order['quantity']); ?>.000VND</td>
                            <td><?php echo $order['quantity']; ?></td> 
                            <td><img src="<?php echo htmlspecialchars($order['product_image']); ?>" alt="img" class="product-img"></td> 
                            <td><?php echo htmlspecialchars($order['category_name']); ?></td> 
                            <td><?php echo htmlspecialchars($order['order_date']) ?></td>
                            <td class="status"><?php echo htmlspecialchars($order['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody
