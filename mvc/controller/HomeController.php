<?php
    require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Controller.php');
    require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\ProductModel.php');

    class HomeController extends Controller {
        public $ProductModel;

        public function index() {
            $productModel = new ProductModel();
            $bestSaleProduct = $productModel->getBestSaleProduct();

            // Kiểm tra sản phẩm tồn tại
            if (!$bestSaleProduct) {
                die("Sản phẩm không tồn tại");
            }

            $this->view("homepage", ["bestSaleProduct" => $bestSaleProduct]);
        }
    }
?>