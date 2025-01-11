<?php
error_reporting(E_ALL); // Báo cáo tất cả lỗi
ini_set('display_errors', 1); // Hiển thị lỗi khi có

class Db {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "freshLeaf_website"; // Tên cơ sở dữ liệu của bạn
    protected $conn;

    public function __construct() {
        // Kết nối cơ sở dữ liệu với OOP MySQLi
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Kiểm tra lỗi kết nối
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error); // In ra lỗi chi tiết
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    // Phương thức đóng kết nối (tốt cho việc sử dụng lâu dài)
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Tạo đối tượng Db để kết nối cơ sở dữ liệu
$db = new Db();

// Sử dụng kết nối
$conn = $db->getConnection();

// Đóng kết nối sau khi sử dụng
$db->closeConnection();
?>
