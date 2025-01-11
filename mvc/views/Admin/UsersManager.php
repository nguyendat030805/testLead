<?php
    require_once('C:\xampp\htdocs\Testfreshlead\mvc\controller\AdminController.php');
    $Users = $data['user'];
    $totalPages = $data['totalPages'];
    $currentPage= $data['currentPage'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Testfreshlead/public/css/users.css?v=<?php echo time();?>">
    <title>Users Manager</title>
</head>
<body>
    <div class="title">
        <img src="/Testfreshlead/public/images/logo_website.png" alt="">
        <h1>Users Manager</h1>
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
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Users as $user): ?>
                        <tr class="tableBody">
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>0<?php echo $user['phone']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td><?php echo $user['address'] ?></td>
                            <td class="action">
                                <form method="POST" action="/Testfreshlead/Admin/deleteUser" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" class="delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                    <div class="contentDetail"><a href="/Testfreshlead/Admin/userDetail/<?php echo $user['user_id'] ?>"><i class="fa fa-eye" style="font-size:20px"></i>Xem chi tiết</a></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="/Testfreshlead/Admin/UserManager?page=<?php echo $i; ?>"
                    class="<?php echo $i === $currentPage ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
</body>
</html>