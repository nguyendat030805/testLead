<?php
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Db.php');

class OrderModel extends Db {
    public function getPendingOrderId($user_id) {
        $sql = "SELECT order_id FROM orders WHERE user_id = ? AND status = 'pending'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['order_id'] ?? null;
    }

    public function createOrder($user_id) {
        $sql = "INSERT INTO orders (user_id, status) VALUES (?, 'pending')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function updateOrderStatus($order_id, $status) {
        $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $order_id);
        $stmt->execute();
    }
    public function getUserOrders($user_id) {
        $sql = "SELECT order_id, status, order_date FROM orders WHERE user_id = ? ORDER BY order_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy danh sách sản phẩm trong lịch sử mua hàng
    public function getOrderHistoryWithProducts($user_id) {
        $sql = "
            SELECT 
                o.order_id,
                o.status,
                o.order_date
            FROM orders o
            WHERE o.user_id = ? AND status = 'completed'
            ORDER BY o.order_date DESC, o.order_id DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result= $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }
}
?>
