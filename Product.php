<?php
include "Query.php";

class Product extends Query {
    private $tableName = "products";

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function getProducts() {
        return $this->fetch("*");
    }

    public function createProduct(array $data) {
        return $this->create($data);

    }

    public function massDeleteProducts(array $ids) {
        return $this->deleteProducts($ids);
    }
}