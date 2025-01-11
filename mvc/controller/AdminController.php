<?php
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\UserModel.php');
require_once('C:\xampp\htdocs\Testfreshlead\mvc\model\ProductModel.php');
session_start();
require_once('C:\xampp\htdocs\Testfreshlead\mvc\core\Controller.php');
    class AdminController extends Controller{
        private $model;
        private $productModel;
        public function __construct(){
            $this->model = new UserModel();
        }
        public function UserManager(){
            $limit = 6;
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $offset = ($page - 1) * $limit;
            $this->model = new UserModel();
            $getUser = $this->model->getAllUserPagination($limit, $offset);
            $totalUser = $this->model->getCoutnUser();
            $totalPages = ceil($totalUser / $limit);
            if (empty($getUser)) {
                echo "Không có sản phẩm nào trong Database";
            } else {
                $this->view("./Admin/UsersManager", ["user" => $getUser,"totalPages" => $totalPages,"currentPage" => $page]);
            }
        }
        public function deleteUser() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
                $userId = intval($_POST['user_id']);
                $isDelete = $this->model->deleteUser($userId);
                if ($isDelete) {
                    header("Location: /Testfreshlead/Admin/UserManager");
                    exit();
                } else {
                    header("Location: /Testfreshlead/Admin/UserManager");
                    exit();
                }
            } else {
                echo "Invalid request.";
            }
        }

        public function ProductManager()
        {
            $limit = 6;
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $offset = ($page - 1) * $limit;
            $this->productModel = new ProductModel();
            $getProduct = $this->productModel->getAllProductPagination($limit, $offset);
            $totalProducts = $this->productModel->countProduct();
            $totalPages = ceil($totalProducts / $limit);
            if (empty($getProduct)) {
                echo "Không có sản phẩm nào trong Database";
            } else {
                $this->view("./Admin/ProductsManager", ["product" => $getProduct,"totalPages" => $totalPages,"currentPage" => $page]);
            }
        }

        public function deleteProduct(){
            $this->productModel = new ProductModel();
            if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['product_id'])){
                $product_id = intval($_POST['product_id']);
                $isdelete = $this->productModel->deleteProduct($product_id);
                if($isdelete){
                    header("Location: /Testfreshlead/Admin/ProductManager");
                    exit();
                }else{
                    header("Location: /Testfreshlead/Admin/ProductManager");
                    exit();
                }
            }else{
                echo "Invalid request.";
            }
        }
        public function editProduct() {
            $this->productModel = new ProductModel();
            if (isset($_GET['id'])) {
                $product_id = $_GET['id'];
                $product = $this->productModel->getProductById($product_id);
                $categories = $this->productModel->getAllCategories();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $product_name = $_POST['product_name'] ?? '';
                    $price = $_POST['price'] ?? '';
                    $description = $_POST['description'] ?? '';
                    $unit = $_POST['unit'] ?? '';
                    $image = $_POST['product_image'] ?? '';
                    $category_id = $_POST['category_id'] ?? '';
        
                    
                    $result = $this->productModel->editProduct(
                        $product_id,
                        $product_name,
                        $price,
                        $description,
                        $unit,
                        $image,
                        $category_id
                    );
        
        
                    if ($result) {
                        // Redirect đến trang quản lý sản phẩm
                        header("Location: /Testfreshlead/Admin/ProductManager");
                        exit();
                    } else {
                        echo "Cập nhật sản phẩm thất bại!";
                    }
                }
        
                // Hiển thị form chỉnh sửa
                $this->view("/Admin/EditProduct",['edit' => $product, 'categories' => $categories]);
            } else {
                echo "Không tìm thấy sản phẩm!";
            }
        }
        // $product_name, $price, $description, $unit, $image, $category_id
        public function CreateProduct(){
            $this->productModel=new ProductModel();
            $categories = $this->productModel->getAllCategories();
            if($_SERVER['REQUEST_METHOD']==='POST'){
                $product_name = $_POST['product_name'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                $unit = $_POST['unit'];
                $stock_quantity = $_POST['stock_quantity'];
                $image = $_POST['product_image'];
                $category_id = $_POST['category_id'];
                $result = $this->productModel->addProduct($product_name, $price, $description, $unit, $stock_quantity,$image, $category_id);
                if(isset($result)){
                    header("Location: /Testfreshlead/Admin/ProductManager");
                }
                else{
                    echo "Thêm sản phẩm thất bại";
                }
            }
            $this->view("/Admin/CreateProduct",['categories' => $categories]);
        }
        public function Categories(){
            $this->productModel = new ProductModel();
            $categories = $this->productModel->getAllCategories();
            if (empty($categories)){
                echo "Không có category nào trong Database cả";
            }
            else{
                $this->view("/Admin/CategorisManager",['category'=>$categories]);
            }
        }
        public function DeleteCategory(){
            $this->productModel= new ProductModel();
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])){
                $category_id = intval($_POST['category_id']);
                $delete = $this->productModel->deleteCategory($category_id);
                if($delete){
                    header("Location: /Testfreshlead/Admin/Categories");
                    exit();
                }else{
                    header("Location: /Testfreshlead/Admin/Categories");
                    exit();
                }
            }
            else{
                echo "Không có ID Category";
            }
        }
        public function userDetail($user_id) {
            $this->model = new UserModel();
            $userDetail = $this->model->getAllDetailUser($user_id);
            if (empty($userDetail['userDetails'])) {
                echo "Không có thông tin cho người dùng này.";
            } else {
                $this->view('./Admin/UserDetail', [
                    'userDetails' => $userDetail['userDetails'],
                    'orders' => $userDetail['orders']
                ]);
            }
        }
        
    }
?>