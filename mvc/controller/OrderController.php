<?php
session_start();
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Controller.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\OrderModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\OrderDetailModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\ShippingInfoModel.php');

class OrderController extends Controller {
    public function placeOrder() {

        $user_id = $_SESSION['user_id'];
        $data = json_decode(file_get_contents("php://input"), true);

        // Kiểm tra các trường bắt buộc
        $requiredFields = ['recipient_name', 'email', 'phone', 'address', 'city'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                echo json_encode(["success" => false, "message" => "Bạn chưa nhập $field."]);
                return;
            }
        }

        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
        $shippingInfoModel = new ShippingInfoModel();

        // Lấy giỏ hàng đang chờ xử lý
        $order_id = $orderModel->getPendingOrderId($user_id);
        if (!$order_id) {
            echo json_encode(["success" => false, "message" => "Không tìm thấy giỏ hàng."]);
            return;
        }

        // Thêm thông tin vận chuyển
        $recipient_name = $data['recipient_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $address = $data['address'];
        $city = $data['city'];
        $note = $data['note'] ?? '';

        $shippingInfoModel->addShippingInfo($order_id, $recipient_name, $email, $phone, $address, $city, $note);

        // Cập nhật trạng thái đơn hàng
        $orderModel->updateOrderStatus($order_id, 'completed');

        echo json_encode(["success" => true, "message" => "Đặt hàng thành công."]);
    }

    public function viewOrderPage() {
    
        $user_id = $_SESSION['user_id'];
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
    
        $order_id = $orderModel->getPendingOrderId($user_id);
        if (!$order_id) {
            header("Location: /Testfreshlead/ShoppingCart");
            exit;
        }
    
        $cartItems = $orderDetailModel->getOrderDetails($order_id);
        $totalAmount = array_reduce($cartItems, fn($sum, $item) => $sum + $item['line_total'], 0);
    
        $this->view("Order", [
            "cartItems" => $cartItems,
            "totalAmount" => $totalAmount
        ]);
    }
    
}
