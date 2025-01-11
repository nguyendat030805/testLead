<?php
session_start();
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\ReviewModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\UserModel.php');

class ReviewController extends Controller {

    private $reviewModel;

    public function __construct() {
        $this->reviewModel = new ReviewModel();
    }

    // Hiển thị form đánh giá
    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // Lấy dữ liệu từ GET (thông tin sản phẩm và đơn hàng)
            $data = [
                'user_id' => $_SESSION['user_id'] ?? null,
                'order_id' => $_GET['order_id'] ?? null,
                'product_id' => $_GET['product_id'] ?? null
            ];

            // Kiểm tra dữ liệu GET
            if (empty($data['user_id']) || empty($data['order_id']) || empty($data['product_id']) && $_GET['review_type'] === 'single_product') {
                die("Thông tin không hợp lệ. Vui lòng kiểm tra lại.");
            }

            // Lấy danh sách sản phẩm từ đơn hàng
            $data['orderProduct'] = $this->reviewModel->getOrderProductsByOrderId($data['order_id'], $data['product_id']);

            // Gửi dữ liệu tới view
            require_once 'C:\xampp\htdocs\Testfreshlead\mvc\views\Review.php';
        }

        // Xử lý POST khi người dùng gửi đánh giá
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra dữ liệu gửi đến từ POST        
            $userId = $_SESSION['user_id'] ?? null;
            $productId = $_POST['product_id'] ?? null;
            $rating = $_POST['rating'] ?? null;
            $comment = $_POST['comment'] ?? null;

                if (empty($productId)) {
                    foreach ($_POST as $key => $value) {
                        if (str_starts_with($key, 'product_id_')) {
                            $productId = $value;
                            break;
                        }
                    }
                }
                $rating = $_POST['rating_' . $productId] ?? null; 
                $comment = $_POST['comment_' . $productId] ?? null;
                // Kiểm tra thông tin đầy đủ
                if (empty($userId) || empty($productId) || empty($rating) || empty($comment)) {
                    echo "Please fill in all information!";
                    return;
                }

                // Kiểm tra rating là một số và nằm trong khoảng từ 1 đến 5
                if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
                    error_log("Rating không hợp lệ: $rating");
                    echo "Số sao không hợp lệ!";
                    return;
                }

                // Gọi phương thức addReview từ model
                $result = $this->reviewModel->addReview($userId, $productId, $rating, $comment);

                if ($result) {
                    // Đặt thông báo thành công trong session
                    $_SESSION['alert'] = "You have successfully evaluated!";
                    
                    // Chuyển hướng về trang Order History
                    header("Location: /Testfreshlead/orderHistory/OrderHistory");
                    exit;
                } else {
                    echo "Có lỗi xảy ra khi lưu đánh giá.";
                }
            }
        }
        public function getReviews($product_id) {
            $this->reviewModel = new ReviewModel();
            $reviews = $this->reviewModel->getReview($product_id);
            $this->view("./Product/Detail", ['reviews' => $reviews]);
        }
        
        
        
    }

?>
