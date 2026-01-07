<?php
class Database {
    private $host = "localhost";
    private $db_name = "if0_39957867_canasta";  //tener presente colocar el valor según nombre de la base de datos
    private $username = "root";  //tener presente colocar el valor según entorno del gestor de la base de datos
    private $password = "Pipefelipe123";  //tener presente colocar el valor según entorno del gestor de la base de datos
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>

