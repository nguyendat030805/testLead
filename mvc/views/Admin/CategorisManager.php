<?php
    require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\AdminController.php');
    $categories = $data['category'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Testfreshlead/public/css/categories.css?v=<?php echo time();?>">
    <title>Users Manager</title>
</head>
<body>
    <div class="title">
        <img src="/Testfreshlead/public/images/logo_website.png" alt="">
        <h1>Categories Manager</h1>
        <div class="logout"><a href="/Testfreshlead/User/Logout"><i class="fa fa-sign-out" style="font-size:36px"></i></a></div>
    </div>
    <div class="content">
        <div class="navigation">
            <button class="btn">
                <a href="/Testfreshlead/Admin/UserManager"><i class="fa fa-user-circle-o" style="font-size:36px"></i>Users Manager</a>
            </button>
            <button class="btn">
            <a href="/Testfreshlead/Admin/ProductManager">
            <i class="fas fa-cube" style="font-size:36px"></i>
                Product Manager
            </a>
            </button>
            <button class="btn">
                <a href="/Testfreshlead/Admin/Categories">
                <i class="fa fa-list-alt" style="font-size:36px;"></i>Categories
                </a>
            </button>
        </div>
        <div class="tableContent">
            <table>
                <thead>
                    <tr class="product_content">
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category): ?>
                        <tr>
                            <td><?php echo $category['category_id'] ?></td>
                            <td><?php echo $category['category_name'] ?></td>
                            <td class="action">
                                <form action="/Testfreshlead/Admin/DeleteCategory" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                                    <button class="delete-btn" type="submit"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>