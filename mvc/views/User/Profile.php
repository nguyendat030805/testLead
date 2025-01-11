<?php
require_once 'C:\xampp\htdocs\Testfreshlead\mvc\core\Db.php';
require_once 'C:\xampp\htdocs\Testfreshlead\mvc\controller\UserController.php';
include 'C:\xampp\htdocs\Testfreshlead\mvc\views\layout\header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Login.php');
    exit;
}

global $conn;
$controller = new UserController($conn);
$userId = $_SESSION['user_id'];
$userData = $controller->getProfile($userId);
$controller->handleChangePassword();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Testfreshlead/Public/Css/Profile.css?v=<?php echo time();?>">
</head>
<style>
    body {
    font-family: "Quicksand", serif;
    margin: 10px;
    padding: 10px;
}
.container_profile {
    margin-top: 100px;
    display: flex;
    padding: 10px;
}
.sidebar {
    width: 15%;
    background-color:rgb(73, 212, 96);
    padding: 18px;
    border-radius: 10px;
}
.sidebar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
.sidebar h3 {
    margin: 10px 0 5px;
    font-size: 18px;
}
.sidebar p {
    margin: 0;
    color: #666;
}
.sidebar .menu-profile {
    margin-top: 20px;
}
.sidebar .menu-profile a {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #333;
    padding: 10px 0;
    font-size: 16px;
}
.sidebar .menu-profile a:hover {
    color: white;
}
.section-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}
.container_infor {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 80%;
    margin: 20px ;
    padding: 20px;
    padding-right: 30px;
    position: relative;
}
.container_inforUser {
    display: flex;
    flex-direction: column;
    border: 1px grey solid;
    border-radius: 10px;
    padding: 10px;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 15px;
}
.form-group input {
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}
.form-group .save-changes {
    width: 14%;
    padding: 5px;
    font-size: 15px;
    border: 2px solid #28a745;
    border-radius: 20px;
    background-color: #28a745;
    color:white;
    font-weight: bold;
    cursor: pointer;
}
.form-userAvatar img {
    position: absolute;
    top: 15%;
    margin-left: 70%;
    border-radius: 50%;
    width: 150px;
    object-fit: cover;
    height: 150px;
    border: 1px grey solid;
}
.form-userAvatar input[type="file"] {
    display: none;
}
.form-userAvatar .uploadImage {
    position: absolute;
    top: 46%;
    margin-left: 71%;
    width: 10%;
    padding: 10px;
    border: 2px solid #28a745;
    border-radius: 20px;
    color: #28a745;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.1s ease-out;
}
.form-userAvatar .uploadImage:hover {
    transform: scale(1.01);
}
.container_changePassword {
    display: flex;
    flex-direction: column;
    border: 1px grey solid;
    border-radius: 10px;
    padding: 20px;
}
.form-change label {
    display: block;
    margin-bottom: 5px;
    font-size: 15px;
}
.form-change input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}
.current_password {
    position: relative;
}
.current_password input {
    width:93%;
    padding-right: 40px;
    box-sizing: border-box;
}
.changes-password {
    display: flex;
    gap: 200px;
}
.form-changePass {
    width: 400px;
    margin-top: 15px;
}
.changes-password .password-container input{
    width: 80%;
    padding-left: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}
.password-container {
    position: relative;
}
.form-change .change-password {
    margin-top: 10px;
    width: 15%;
    font-size: 15px;
    padding: 5px;
    border: 2px solid #28a745;
    border-radius: 20px;
    background-color: #28a745;
    color:white;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}
.container_changePassword .current_password .password-eye {
   position: absolute;
   left: 90%;
   top: 11px;
}
.password-container .password-eye {
    position: absolute;
    top: 11px;
    left: 72%;
}
</style>
<body>
<div class="container_profile">
        <div class="sidebar" style="height: 75%;">
            <img alt="User Avatar" height="50" src="/Public/Image/<?php echo htmlspecialchars($userData['avatar']); ?>" width="50"/>
            <h3><?php echo $userData['user_name']; ?></h3>
            <p><?php echo $userData['email']; ?></p>
            <div class="menu-profile">
                <a href="#"><i class="fas fa-user"></i>My Profile</a>
                <a href="/Testfreshlead/OrderHistory/orderHistory"><i class="fas fa-file-alt"></i>My Orders History</a>
                <a href="/Testfreshlead/ShoppingCart/viewCart"><i class="fas fa-shopping-cart"></i>My Shopping Cart</a>
            </div>
        </div>
        <div class="container_infor" style="margin-left: 55%; width: 400%;">
            <form action="" method="POST" enctype="multipart/form-data">
            <div class="container_inforUser">
                <div class="section-title">My Profile</div>
                <div class="form-group">
                    <label>User name</label>
                    <input name="username" type="text" value="<?php echo $userData['user_name']; ?>"/>
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input name="fullname" type="text" value="<?php echo $userData['user_name'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" value="<?php echo $userData['email']; ?>"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input name="phone" type="text" value="<?php echo $userData['phone']; ?>"/>
                </div>
                <div class="form-userAvatar">
                    <div class="uploadImage">Choose Image</div>
                    <img id="avatarPreview" alt="Profile image" src="/Public/Image/<?php echo htmlspecialchars($userData['avatar']); ?>" />
                    <input id="chooseImage" type="file" name="avatar" accept="Image/*" onchange="previewAvatar(event)" />
                    
                </div>

                <div class="form-group">
                    <button class="save-changes" name="update">Save Changes</button>
                </div>
            </div>
            </form>
            <form method="POST" enctype="multipart/form-data">
            <div class="container_changePassword">
                <div class="section-title">Change Password</div>
                <div class="form-change">
                    <label for="current-password">Current Password</label>
                    <div class="current_password">
                        <input name="current-password" type="password" value=""/>
                        <i class="fas fa-eye-slash password-eye"></i>
                    </div>
                </div>
                <div class="changes-password">
                    <div class="form-changePass">
                        <label for="new-password">New Password </label>
                        <div class="password-container">
                            <input name="new-password" type="password" value=""/>
                            <i class="fas fa-eye-slash password-eye"></i>
                        </div>
                    </div>
                    <div class="form-changePass">
                        <label for="confirm-password">Confirm New Password</label>
                        <div class="password-container">
                            <input name="confirm-password" type="password" value=""/>
                            <i class="fas fa-eye-slash password-eye"></i>
                        </div>
                    </div>
                </div>
                <div class="form-change">
                    <button class="change-password">Change Password</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="\Testfreshlead\public\js\profile.js"></script>
</body>
</html>