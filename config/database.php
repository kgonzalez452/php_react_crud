<?php
class Database{
    //specify your own db credentials
    private $host = 'localhost';
    private $db_name = 'php_react_crud';
    private $username = 'root';
    private $password = '';
    public $connect;
    
    public function getConnection() {
        $this->connect = null;

        try {
            $this->connect= new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo 'Connection error:' . $exception->getMessage();
        }
        return $this->connect;
    }
}