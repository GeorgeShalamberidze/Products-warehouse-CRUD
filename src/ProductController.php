<?php
require_once("./src/Validator.php");

class ProductController {
    private $product;
    public function __construct($p) {
        $this->product = $p;
    }   

    public function processRequest(string $method): void {
        $this->handleCollection($method);
    }

    private function handleCollection(string $method) {
        switch ($method) {
            case "GET":
                echo json_encode($this->product->getProducts());
                http_response_code(200);
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);
                new Validator($data);
                http_response_code(201);
                $this->product->createProduct($data);
                break;
            case "DELETE":
                $idArr = json_decode(file_get_contents("php://input"), true);
                if (!empty($idArr) && is_array($idArr)) {
                    $this->product->massDeleteProducts($idArr);
                    echo json_encode([
                        "message" => "Product Was Deleted Successfully",
                    ]);
                }
                break;
            default: 
                http_response_code(405); // Not Allowed  
        }
    }
}