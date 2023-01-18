<?php

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
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);
                http_response_code(201);
                $this->product->createProduct($data);
                echo json_encode([
                    "message" => "Product Was Created Successfully",
                ]);
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