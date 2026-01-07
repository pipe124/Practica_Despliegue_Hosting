<?php
include_once '../config/Database.php';
include_once '../models/Producto.php';

class ProductoController {
    private $producto;

    public function __construct() {
        ini_set('display_errors', 0);
        error_reporting(E_ALL);

        $database = new Database();
        $db = $database->getConnection();

        if (!$db) {
            $this->sendResponse(500, ["message" => "Error al conectar con la base de datos."]);
        }

        $this->producto = new Producto($db);
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'POST':
                $this->createProducto();
                break;
            default:
                $this->sendResponse(405, ["message" => "Método no permitido."]);
        }
    }

    private function createProducto() {
        $data = json_decode(file_get_contents("php://input"));

        // Validación según TU modelo
        if (
            !isset($data->Nombre) ||
            !isset($data->Categoria) ||
            !isset($data->Precio)
        ) {
            $this->sendResponse(400, ["message" => "Datos incompletos."]);
            return;
        }

        // Asignación EXACTA al modelo
        $this->producto->Nombre = $data->Nombre;
        $this->producto->Categoria = $data->Categoria;
        $this->producto->Precio = $data->Precio;

        if ($this->producto->create()) {
            $this->sendResponse(201, ["message" => "Producto agregado con éxito."]);
        } else {
            $this->sendResponse(500, ["message" => "Error al agregar el producto."]);
        }
    }

    private function sendResponse($statusCode, $data) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }
}

$controller = new ProductoController();
$controller->handleRequest();
?>

