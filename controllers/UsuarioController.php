<?php
include_once 'config/Database.php';
include_once 'models/Usuario.php';

class UsuarioController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function create() {
        header("Content-Type: application/json; charset=UTF-8");
        $data = json_decode(file_get_contents("php://input"));
    
        if (!empty($data->nombre_usuario) && !empty($data->email) && !empty($data->contrasena)) {
            $this->usuario->nombre_usuario = $data->nombre_usuario;
            $this->usuario->email = $data->email;
            $this->usuario->contrasena = $data->contrasena;
    
            if ($this->usuario->exists()) {
                echo json_encode(["error" => true, "message" => "El nombre de usuario o correo ya está en uso."]);
                return;
            }
    
            if ($this->usuario->create()) {
                echo json_encode(["error" => false, "message" => "Usuario registrado exitosamente...."]);
            } else {
                // NUEVA LÍNEA PARA DIAGNOSTICAR EL ERROR
                echo json_encode(["error" => true, "message" => "Error SQL: " . implode(", ", $this->db->errorInfo())]);
            }
        } else {
            echo json_encode(["error" => true, "message" => "Datos incompletos."]);
        }
    }
    

}

// Manejar la solicitud POST para crear un usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $controller->create();
}
?>
