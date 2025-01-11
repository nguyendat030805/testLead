<?php  
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Db.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    class UserModel extends Db{
        public function Register($username, $hashedPassword, $email, $phone, $address, $role = null, $avatar = null){
            $checkAccount = "SELECT * FROM users WHERE email=?";
            $stmt = $this->conn->prepare($checkAccount);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                return 'Username or email already exists';
            }
    
            // Kiểm tra số lượng người dùng
            $countQuery = "SELECT COUNT(*) AS user_count FROM users";
            $stmt = $this->conn->prepare($countQuery);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result && $row = $result->fetch_assoc()) {
                $userCount = $row['user_count'];
            } else {
                return "Error: Unable to fetch user count.";
            }
    
            $role = ($userCount == 0) ? "Admin" : ($role ?: "User");
    
            $sql = "INSERT INTO users (user_name, password, email, phone, role, avatar, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssisss", $username, $hashedPassword, $email, $phone, $role, $avatar, $address);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return "Error: " . $stmt->error;
            }
        }
        public function getUserId($user_id){
            $query = "SELECT * FROM users WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc() ?? null;
        }
        public function getUserInfo($email) {
            // Truy vấn SQL kiểm tra người dùng với email và mật khẩu
            $checkAccount = "SELECT user_id, user_name, email, password, avatar, role FROM users WHERE email = ?";
            
            // Chuẩn bị câu truy vấn
            $stmt = $this->conn->prepare($checkAccount);
            $stmt->bind_param("s", $email); 
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Kiểm tra nếu có dữ liệu người dùng
            if ($result->num_rows > 0) {
                // Lấy thông tin người dùng
                return $result->fetch_assoc();
            } else {
                return null; // Nếu không tìm thấy người dùng
            }
        }
        public function updateUser($userId, $username, $address, $email, $phone, $avatar){
            if ($avatar) {
                $query = "
                    UPDATE users 
                    SET user_name = ?, address = ?, email = ?, phone = ?, avatar = ? 
                    WHERE user_id = ?
                ";
                $stmt = $this->conn->prepare($query);
                if ($stmt === false) {
                    die('Chuẩn bị câu truy vấn bị lỗi: ' . $this->conn->error);
                }
                $stmt->bind_param("sssssi", $username,$address, $email, $phone, $avatar, $userId);
            } else {
                $query = "
                    UPDATE users 
                    SET user_name = ?, address = ?, email = ?, phone = ? 
                    WHERE user_id = ?
                ";
                $stmt = $this->conn->prepare($query);
                if ($stmt === false) {
                    die('Chuẩn bị câu truy vấn bị lỗi: ' . $this->conn->error);
                }
                $stmt->bind_param("sssssi", $username, $address, $email, $phone,$avatar, $userId);
            }
            $result = $stmt->execute();
            if (!$result) {
                die('Lỗi thực thi câu truy vấn: ' . $stmt->error);
            }
            return $result;
        }
        public function changePassword($userId, $currentPassword, $newPassword) {
            $query = "SELECT password FROM users WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
    
            if (!$user || !password_verify($currentPassword, $user['password'])) { 
                return false; 
            }
            
            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
            $query = "UPDATE users SET password = ? WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $hashedNewPassword, $userId);
            return $stmt->execute();
        }

        //Kiểm tra email có tồn tại trong cơ sở dữ liệu không
        public function doesEmailExist($email) {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->num_rows > 0;
        }

        // Cập nhật mật khẩu mới
        public function updatePassword($email, $hashedPassword) {
            $query = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $hashedPassword, $email);
            return $stmt->execute();
        }
        
        // Gửi mã reset mật khẩu và lưu mã vào cơ sở dữ liệu
        public function sendResetCode($email) {
            $resetCode = rand(100000, 999999); // Mã gồm 6 chữ số
            $expiryTime = date('Y-m-d H:i:s', time() + 300); // Hết hạn sau 5 phút (300 giây)

            // Lưu mã và thời gian hết hạn vào bảng users
            $query = "UPDATE users SET reset_code = ?, reset_expires_at = ? WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iss", $resetCode, $expiryTime, $email);
            $stmt->execute();

            // Gửi email với mã xác nhận
            return $this->sendEmail($email, $resetCode);
        }

        // Xác minh mã reset có hợp lệ và chưa hết hạn
        public function verifyResetCode($email, $code) {
            $query = "SELECT * FROM users WHERE email = ? AND reset_code = ? AND reset_expires_at > NOW()";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $email, $code);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Mã xác nhận hợp lệ, xóa mã khỏi cơ sở dữ liệu sau khi sử dụng
                $query = "UPDATE users SET reset_code = NULL, reset_expires_at = NULL WHERE email = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                return true;
            } else {
                return "Mã xác nhận không hợp lệ hoặc đã hết hạn.";
            }
        }

        // Hàm gửi email mã reset
        public function sendEmail($email, $resetCode) {
            require_once 'C:\xampp\htdocs\freshleaf_website\vendor\PHPMailer-master\src\PHPMailer.php';
            require_once 'C:\xampp\htdocs\freshleaf_website\vendor\PHPMailer-master\src\SMTP.php';
            require_once 'C:\xampp\htdocs\freshleaf_website\vendor\PHPMailer-master\src\Exception.php';

            $mail = new PHPMailer(true);

            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'kim.ho26@student.passerellesnumeriques.org';
                $mail->Password = 'qmuk aqgo zimx olwg';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Cấu hình người gửi và người nhận
                $mail->setFrom('no-reply@freshleaf.com', 'Freshleaf Support');
                $mail->addAddress($email);

                $mail->CharSet = 'UTF-8';

                // Nội dung email
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "
                    <h1>Hello,</h1>
                    <p>You have requested a password reset for your account.</p>
                    <p>Your reset code is: <strong>$resetCode</strong></p>
                    <p>Please use this code to reset your password. The code will expire in 1 hour.</p>
                    <p>If you did not make this request, please ignore this email.</p>
                    <br>
                    <p>Thank you,<br>Freshleaf Support</p>
                ";

                // Gửi email
                return $mail->send();
            } catch (Exception $e) {
                error_log("Email could not be sent. Error: {$mail->ErrorInfo}");
                return false;
            }
        }
        public function getAllUsers() {
            $sql = "SELECT * FROM Users";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $this->conn->error);
            }       
            $stmt->execute();
            $result = $stmt->get_result();
            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        }
        public function getAllUserPagination($limit, $offset) {
            $sql = "SELECT * FROM Users LIMIT ? OFFSET ?";
            $stmt = $this->conn->prepare($sql);
        
            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $this->conn->error);
            }
            $stmt->bind_param("ii", $limit, $offset);
        
            $stmt->execute();
            $result = $stmt->get_result();
            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        }
        public function getCoutnUser(){
            $result = $this->conn->query("SELECT COUNT(*) AS COUNT FROM Users");
            return $result->fetch_assoc()['COUNT'];
        }
        
        public function deleteUser($user_id){
            $sql = "DELETE  FROM users WHERE user_id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $result = $stmt->execute();
            return $result;
        }  
        public function getAllDetailUser($user_id) {
            $sql = "
            SELECT o.order_id, o.order_date, o.status, o.user_id, 
                od.order_detail_id, od.quantity, od.price, 
                od.product_id, p.product_name, p.category_id, p.product_image, c.category_name, u.user_name, u.email, u.phone, u.avatar
            FROM order_detail od
            JOIN products p ON od.product_id = p.product_id
            JOIN categories c ON p.category_id = c.category_id
            JOIN orders o ON od.order_id = o.order_id
            JOIN users u ON o.user_id = u.user_id
            WHERE o.user_id = ?
            ";
        
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $user_id);  
            $stmt->execute();
            $result = $stmt->get_result();
            $user = null;
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                if ($user === null) {
                    $user = [
                        'user_name' => $row['user_name'],
                        'email' => $row['email'],
                        'phone' => $row['phone'],
                        'avatar' => $row['avatar']
                    ];
                }
                $orders[] = [
                    'order_id' => $row['order_id'],
                    'order_date' => $row['order_date'],
                    'status' => $row['status'],
                    'product_name' => $row['product_name'],
                    'quantity' => $row['quantity'],
                    'price' => $row['price'],
                    'product_image' => $row['product_image'],
                    'category_name' => $row['category_name']
                ];
            }
            return ['userDetails' => $user, 'orders' => $orders];
        }
        
        
    }

?>