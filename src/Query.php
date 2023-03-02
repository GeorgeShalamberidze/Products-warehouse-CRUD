<?php
namespace App; 

use App\config\Constants;
use App\config\Database;
use PDO;
class Query {
    private $query = "";
    private $table_name = "products";
    private $stmt;
    private $db;

    function __construct() {
        $this->db = (new Database(Constants::$host, Constants::$dbname, Constants::$user, Constants::$pass))->get();
    }

    public function fetchAllProducts($column) {
        $this->query = "SELECT " .$column . " FROM " . "$this->table_name";
        $this->stmt = $this->db->query($this->query);
        $data = [];
        while($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function fetchSingleProduct($column, $productSKU) {
        $this->query = "SELECT " . $column . " FROM " . "$this->table_name" . " WHERE sku = :sku";
        $this->stmt = $this->db->prepare($this->query);
        $this->stmt->bindValue(":sku", $productSKU);
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data) {
        $table_columns = implode(', ', array_keys($data));
        $table_value = implode("','", $data);
        $this->query="INSERT INTO $this->table_name($table_columns) VALUES('$table_value')";
        $this->stmt = $this->db->prepare($this->query);
        $this->stmt->execute();
        return $this->db->lastInsertId();
    }

    public function deleteProducts($ids) {
        foreach($ids as $value) {
            $this->query =  "DELETE FROM " . "$this->table_name" . " WHERE" . " $this->table_name" . "." . "id = " . $value;
            $this->stmt = $this->db->prepare($this->query);
            $this->stmt->execute();
        }
        return $this->stmt->rowCount();
    }
}