<?php
require_once("./src/products/Furniture.php");
require_once("./src/products/Book.php");
require_once("./src/products/DVD.php");

class Validator {
    protected $attrs;
    function __construct(array $attrs) {
        $this->attrs = $attrs;
        
        switch($attrs["productType"]) {
            case "Book" :
                $book = new Book($this->attrs);
                if ($book->validateValues() == "1") {
                    echo json_encode([
                        "message" => "New Book Was Created Successfully",
                    ]);
                }
                break;
            case "Furniture" :
                $furniture = new Furniture($this->attrs);
                if ($furniture->validateValues() == "1") {
                    echo json_encode([
                        "message" => "New Furniture Was Created Successfully",
                    ]);
                }
                break;
            case "DVD" :
                $DVD = new DVD($this->attrs);
                if ($DVD->validateValues() == "1") {
                    echo json_encode([
                        "message" => "New DVD Was Created Successfully",
                    ]);
                }
                break;
        }
    }
}