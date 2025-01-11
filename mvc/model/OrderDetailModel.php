<?php
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Db.php');

class OrderDetailModel extends Db {
    public function getOrderDetail($order_id, $product_id) {
        $sql = "SELECT * FROM order_detail WHERE order_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateQuantity($order_id, $product_id, $quantity) {
        $sql = "UPDATE order_detail SET quantity = ? WHERE order_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $order_id, $product_id);
        $stmt->execute();
    }

    public function addProductToOrder($order_id, $product_id, $quantity, $price) {
        $sql = "INSERT INTO order_detail (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }

    public function getOrderDetails($order_id) {
        $sql = "
            SELECT od.product_id, c.category_name, p.product_name, p.product_image, p.unit, p.price, od.quantity, (p.price * od.quantity) AS line_total
            FROM order_detail od
            JOIN products p ON od.product_id = p.product_id
            JOIN categories c ON p.category_id = c.category_id
            WHERE od.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalQuantityCart($order_id) {
        $sql = "select sum(quantity) as total_quantity from order_detail where order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function deleteProduct($order_id, $product_id) {
        $sql = "DELETE FROM order_detail WHERE order_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();
    }
    
}
?>
