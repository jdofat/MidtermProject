<?php
class Database {
    private $db_name = 'MidtermProject';
    private $username = 'username';
    private $password = 'password';
    private $host = 'localhost';
    public $conn;

    public function getConnection() {
        $this->conn = null;
            try {
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
        } catch (PDOException $exception) {
    }
  }
}
?>