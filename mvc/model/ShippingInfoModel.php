<?php
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Db.php');

class ShippingInfoModel extends Db {
    public function addShippingInfo($order_id, $recipient_name, $email, $phone, $address, $city, $note) {
        $sql = "INSERT INTO shipping_info (order_id, recipient_name, email, phone, address, city, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issssss", $order_id, $recipient_name, $email, $phone, $address, $city, $note);
        $stmt->execute();
    }
}
