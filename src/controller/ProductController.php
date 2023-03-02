<?php
namespace app\controller;

use App\models\productTypes\Book;
use App\Query;

class ProductController {
    private $query;
    public function __construct() {
        $this->query = new Query();
    }
    
    public function processRequest(string $method): void {
        $this->handleCollection($method);
    }

    private function handleCollection(string $method) {
        switch ($method) {
            case "GET":
                echo json_encode($this->query->fetchAllProducts("*"));
                http_response_code(200);
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);
                $productClassName = "App\\models\\productTypes\\" . $data['productType'];
                $productTypeName = new $productClassName($data);
                $errorMessages = $productTypeName->validateInputs();

                if (isset($data) && !$errorMessages) {
                    http_response_code(201);
                    $this->query->create($data);
                    echo json_encode([
                        "message" => $data["productType"] . " Was Created Successfully",
                    ]);
                } else {
                    echo json_encode([
                        "message" => $errorMessages,
                    ]);
                }

                break;
            case "DELETE":
                $idArr = json_decode(file_get_contents("php://input"), true);
                if (!empty($idArr) && is_array($idArr)) {
                    $this->query->deleteProducts($idArr);
                    echo json_encode([
                        "message" => "Product Was Deleted Successfully",
                    ]);
                }
                break;
            default: 
                http_response_code(405);
        }
    }
}