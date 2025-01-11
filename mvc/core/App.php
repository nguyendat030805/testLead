<?php
class App {
    protected $controller = 'HomeController';  // Controller mặc định
    protected $method = 'index';  
    protected $params = [];  

    public function __construct() {
        $url = $this->parseUrl();  // Lấy URL từ query string

        // Kiểm tra và chọn controller nếu có
        if (isset($url[0]) && file_exists('./mvc/controller/' . $url[0] . 'Controller.php')) {
            $this->controller = $url[0] . "Controller";  // Lấy tên controller
            unset($url[0]);  // Xóa phần tử controller khỏi URL
        }

        // Yêu cầu file controller
        require_once './mvc/controller/' . $this->controller . '.php';
        $controller = new $this->controller;

        // Kiểm tra và chọn method nếu có
        if (isset($url[1]) && method_exists($controller, $url[1])) {
            $this->method = $url[1];  // Lấy tên method
            unset($url[1]);  // Xóa phần tử method khỏi URL
        }

        // Xử lý các tham số còn lại
        $this->params = $url ? array_values($url) : [];

        // Gọi method với tham số tương ứng
        call_user_func_array([$controller, $this->method], $this->params);
    }

    // Hàm phân tích URL và trả về mảng các phần tử
    public function parseUrl() {
        if (isset($_GET['url']) && is_string($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
?>
