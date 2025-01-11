<?php
session_start();
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Controller.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\ProductModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\OrderModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\OrderDetailModel.php');
class ShoppingCartController extends Controller {
    public function addToCart() {

    
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng."]);
            return;
        }
    
        $user_id = $_SESSION['user_id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $product_id = $data['product_id'];
        $quantity = isset($data['quantity']) ? (int)$data['quantity'] : 1;
    
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
        $productModel = new ProductModel();
    
        $order_id = $orderModel->getPendingOrderId($user_id);
        if (!$order_id) {
            $order_id = $orderModel->createOrder($user_id);
        }

        $price = $productModel->getProductPrice($product_id);
    
        $existingProduct = $orderDetailModel->getOrderDetail($order_id, $product_id);
    
        if ($existingProduct) {
            $newQuantity = $existingProduct['quantity'] + $quantity;
            $orderDetailModel->updateQuantity($order_id, $product_id, $newQuantity);
            echo json_encode(["success" => true, "message" => "Đã cập nhật số lượng sản phẩm."]);
        } else {
            $orderDetailModel->addProductToOrder($order_id, $product_id, $quantity, $price);
            echo json_encode(["success" => true, "message" => "Đã thêm sản phẩm mới vào giỏ hàng."]);
        }
    }

    public function updateQuantity() {
    
        $user_id = $_SESSION['user_id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $product_id = $data['product_id'];
        $action = $data['action'];
    
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
    
        $order_id = $orderModel->getPendingOrderId($user_id);
        $existingProduct = $orderDetailModel->getOrderDetail($order_id, $product_id);

        $newQuantity = $existingProduct['quantity'];
        if ($action === "increase") {
            $newQuantity++;
        } elseif ($action === "decrease" && $newQuantity > 1) {
            $newQuantity--;
        }
    
        $orderDetailModel->updateQuantity($order_id, $product_id, $newQuantity);
    
        // Tính toán lại tổng số lượng và tổng tiền
        $cartItems = $orderDetailModel->getOrderDetails($order_id);
        $totalAmount = array_reduce($cartItems, fn($sum, $item) => $sum + $item['line_total'], 0);
        $totalQuantity = array_reduce($cartItems, fn($sum, $item) => $sum + $item['quantity'], 0);
    
        echo json_encode([
            "success" => true,
            "new_quantity" => $newQuantity,
            "line_total" => $existingProduct['price'] * $newQuantity,
            "total_amount" => $totalAmount,
            "total_quantity" => $totalQuantity
        ]);
    }
    
    public function deleteItem() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(["success" => false, "message" => "Bạn cần đăng nhập để xóa sản phẩm."]);
            return;
        }
    
        $user_id = $_SESSION['user_id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $product_id = $data['product_id'];
    
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
    
        $order_id = $orderModel->getPendingOrderId($user_id);
        if (!$order_id) {
            echo json_encode(["success" => false, "message" => "Không tìm thấy giỏ hàng."]);
            return;
        }
    
        // Xóa sản phẩm khỏi order_detail
        $orderDetailModel->deleteProduct($order_id, $product_id);
    
        // Tính toán lại tổng số lượng và tổng tiền
        $cartItems = $orderDetailModel->getOrderDetails($order_id);
        $totalAmount = array_reduce($cartItems, fn($sum, $item) => $sum + $item['line_total'], 0);
        $totalQuantity = array_reduce($cartItems, fn($sum, $item) => $sum + $item['quantity'], 0);
    
        echo json_encode([
            "success" => true,
            "total_amount" => $totalAmount,
            "total_quantity" => $totalQuantity
        ]);
    }    

    public function viewCart() {

        if (!isset($_SESSION['user_id'])) {
            $this->view("ShoppingCart", ["cartItems" => []]);
            return;
        }

        $user_id = $_SESSION['user_id'];

        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();

        $order_id = $orderModel->getPendingOrderId($user_id);
        $cartItems = [];
        $totalQuantity = [];
        if ($order_id) {
            $cartItems = $orderDetailModel->getOrderDetails($order_id);
            $totalQuantity = $orderDetailModel->getTotalQuantityCart($order_id);
        }

        $this->view("ShoppingCart", ["cartItems" => $cartItems, "totalQuantity" => $totalQuantity]);
    }
}
?>