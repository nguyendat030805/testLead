<?php
require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\AdminController.php');
$product = $data['product'];
$totalPages = $data['totalPages']; 
$currentPage = $data['currentPage'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Testfreshlead/public/css/productManager.css?v=<?php echo time(); ?>">
    <title>Products Manager</title>
</head>
<body>
    <div class="title">
        <img src="/Testfreshlead/public/images/logo_website.png" alt="">
        <h1>Products Manager</h1>
        <div class="logout">
            <a href="/Testfreshlead/User/Logout">
                <i class="fa fa-sign-out" style="font-size:36px"></i>
            </a>
        </div>
    </div>
    <div class="create">
        <a href="/Testfreshlead/Admin/CreateProduct">
            <button>Create
                <div class="icon">
                    <i class='fas fa-plus-circle' style='font-size:30px;'></i>
                </div>
            </button>
        </a>
    </div>
    <div class="content">
        <div class="navigation">
            <button class="btn">
                <a href="/Testfreshlead/Admin/UserManager"><i class="fa fa-user-circle-o" style="font-size:36px"></i> Users Manager</a>
            </button>
            <button class="btn">
                <a href="/Testfreshlead/Admin/ProductManager">
                    <i class="fas fa-cube" style="font-size:36px"></i> Product Manager
                </a>
            </button>
            <button class="btn">
                <a href="/Testfreshlead/Admin/Categories">
                    <i class="fa fa-list-alt" style="font-size:36px;"></i> Categories
                </a>
            </button>
        </div>
        <div class="tableContent">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Stock Quantity</th>
                        <th>Image</th>
                        <th>Categories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($product)): ?>
                        <tr>
                            <td colspan="9">No products found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($product as $products): ?>
                            <tr class="product_content">
                                <td><?php echo htmlspecialchars($products['product_id']); ?></td>
                                <td><?php echo htmlspecialchars($products['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($products['price']);?>0</td>
                                <td class="description"><?php echo htmlspecialchars($products['description']); ?></td>
                                <td><?php echo htmlspecialchars($products['unit']); ?></td>
                                <td><?php echo htmlspecialchars($products['stock_quantity']); ?></td>
                                <td class="img">
                                    <img src="<?php echo htmlspecialchars($products['product_image']); ?>" alt="product_image" class="product_image">
                                </td>
                                <td><?php echo htmlspecialchars($products['category_name']); ?></td>
                                <td class="action">
                                    <form action="/Testfreshlead/Admin/deleteProduct" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products['product_id']); ?>">
                                        <button class="delete-btn" type="submit">
                                            <i class="fa fa-trash-o" style="font-size:20px"></i>
                                        </button>
                                    </form>
                                    <a href="/Testfreshlead/Admin/editProduct?id=<?php echo htmlspecialchars($products['product_id']); ?>">
                                        <button type="button" class="edit-btn">
                                            <i class="fa fa-pencil-square-o" style="font-size:20px"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="/Testfreshlead/Admin/ProductManager?page=<?php echo $i; ?>"
                    class="<?php echo $i === $currentPage ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
</body>
</html>
