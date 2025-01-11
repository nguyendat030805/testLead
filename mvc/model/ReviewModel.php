<?php 
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Db.php');

class ReviewModel extends Db {

    /// Phương thức thêm đánh giá vào database
    public function addReview($userId, $productId, $rating, $comment) {
        try {
            // Câu lệnh SQL không còn sử dụng order_id
            $sql = "INSERT INTO reviews (user_id, product_id, rating, comment, review_date) 
                    VALUES (?, ?, ?, ?, NOW())";
    
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Lỗi khi chuẩn bị câu lệnh SQL: " . $this->conn->error);
            }
    
            $stmt->bind_param("iiis", $userId, $productId, $rating, $comment);
    
            // Ghi log câu lệnh SQL và tham số
            error_log("SQL: $sql");
            error_log("Params: userId = $userId, productId = $productId, rating = $rating, comment = $comment");
    
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Lỗi khi thực thi câu lệnh: " . $stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage()); // Ghi lại lỗi
            return false;
        }
    }
    
    

    public function getOrderProductsByOrderId($orderId, $productId = null) {
        // Câu lệnh SQL để lấy sản phẩm theo order_id và có thể là product_id (nếu có)
        $sql = "SELECT od.product_id, p.product_name, od.quantity, od.price, p.product_image 
                FROM order_detail od 
                JOIN products p ON od.product_id = p.product_id 
                WHERE od.order_id = ?";
        
        // Nếu có productId, thêm điều kiện cho product_id
        if ($productId !== null) {
            $sql .= " AND od.product_id = ?";
        }
    
        if ($stmt = $this->conn->prepare($sql)) {
            if ($productId !== null) {
                $stmt->bind_param("ii", $orderId, $productId); // Khi có cả orderId và productId
            } else {
                $stmt->bind_param("i", $orderId); // Khi chỉ có orderId
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return [];
            }
        } else {
            error_log("SQL Error: " . $this->conn->error);
            return [];
        }
    }
    public function getReview($product_id) {
        $sql = "SELECT r.rating, r.comment, r.review_date, r.user_id, u.avatar, u.user_name
                FROM reviews r
                JOIN users u ON r.user_id = u.user_id
                WHERE r.product_id = ?
                ORDER BY r.review_date DESC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    
    
    
}
?>    