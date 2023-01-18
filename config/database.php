<?php
class Database {
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $connection;

    public function __construct($host, $dbname, $user, $pass)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;

        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "CONN FAILED: " . $e->getMessage();
        }
    }

    public function get() {
        return $this->connection;
    }

}