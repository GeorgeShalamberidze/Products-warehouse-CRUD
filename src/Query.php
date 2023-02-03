<?php
require_once("./src/config/database.php");
require_once("constants.php");
abstract class Query {
    private $query = "";
    private $data = array();
    private $table_name;
    private $stmt;
    private $db;

    function __construct($table_name) {
        $this->db = (new Database(Constants::$host, Constants::$dbname, Constants::$user, Constants::$pass))->get();
        $this->table_name = $table_name;
    }

    public function fetch($column) {
        $this->query = "SELECT " .$column . " FROM " . "$this->table_name";
        $this->stmt = $this->db->query($this->query);
        $data = [];
        while($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function create(array $data) {
        $table_columns = implode(', ', array_keys($data));
        $table_value = implode("','", $data);

        $this->query="INSERT INTO $this->table_name($table_columns) VALUES('$table_value')";
        $this->stmt = $this->db->prepare($this->query);

        
        if (isset($data)) {
            foreach ($data as $key => $value) {
                if ($this->getTypes($data) === 1) {
                    $this->stmt->bindValue($key, $value, PDO::PARAM_INT);
                } else {
                    $this->stmt->bindValue($key, $value, PDO::PARAM_STR);
                }
            }
            $this->stmt->execute();
    
            return $this->db->lastInsertId();
        }
    }

    public function deleteProducts($ids) {
        $sql = "";
        if (!empty($ids) && is_array($ids)) {
            $sql .= " WHERE";
            $i = 0;
            foreach($ids as $value) {
                $i++;
                $this->query =  "DELETE FROM " . "$this->table_name" .$sql. " $this->table_name" . "." . "id = " . $value;
                $this->stmt = $this->db->prepare($this->query);
                $this->stmt->execute();
            }
            return $this->stmt->rowCount();
        } 
    }
    private function getTypes($data): string
    {
        $types = '';
        foreach ($data as $key => $value) {
            $types .= $this->getDataType($value);
        }
        return $types;
    }

    private function getDataType($data)
    {
        switch(gettype($data))
        {
            case 'integer': return 1;
            case 'string': return 2;
            default: return 2;
        }
    }
}