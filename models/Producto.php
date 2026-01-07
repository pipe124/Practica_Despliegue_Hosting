<?php

class Producto {

    private $conn;
    private $table_name = "producto";

    public $ID_Producto;
    public $Nombre;
    public $Categoria;
    public $Precio;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  (Nombre, Categoria, Precio)
                  VALUES (:Nombre, :Categoria, :Precio)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":Nombre", htmlspecialchars(strip_tags($this->Nombre)));
        $stmt->bindParam(":Categoria", htmlspecialchars(strip_tags($this->Categoria)));
        $stmt->bindParam(":Precio", htmlspecialchars(strip_tags($this->Precio)));

        return $stmt->execute();
    }
}
?>