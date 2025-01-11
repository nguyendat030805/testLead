<?php
session_start();
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Controller.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\OrderModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\OrderDetailModel.php');

class OrderHistoryController extends Controller {
    private $orderModel;
    private $orderDetailModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
    }

    public function orderHistory() {
        // Lấy thông tin đơn hàng và sản phẩm
        $user_id = $_SESSION['user_id'];
        $categories = $this->orderModel->getOrderHistoryWithProducts($user_id);
        
        $orders = [];
        foreach ($categories as $row) {
            $order_id = $row['order_id'];
            if (!isset($orders[$order_id])) {
                $orders[$order_id] = [
                    'order_id' => $order_id,
                    'status' => $row['status'],
                    'order_date' => $row['order_date'],
                    'details' => [],
                ];
            }

            // Lấy chi tiết của từng sản phẩm trong đơn hàng
            $orderDetails = $this->orderDetailModel->getOrderDetails($order_id);

            // Thêm chi tiết sản phẩm vào mảng đơn hàng
            foreach ($orderDetails as $detail) {
                $orders[$order_id]['details'][] = [
                    'product_id' => $detail['product_id'],
                    'product_name' => $detail['product_name'],
                    'product_image' => $detail['product_image'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                    'line_total' => $detail['line_total'],  // Tổng tiền của từng sản phẩm
                ];
            }
        }

        // Gửi dữ liệu đến view
        $this->view("OrderHistory",['orders' => $orders]);
    }
}
?>
