<?php

class Crud {

    private $pdo;
    private $connstring = "mysql:host=127.0.0.1;dbname=kevins_webshop";
    private $username = "Kevins_WebShopUser";
    private $password = "GebruikerWebShop";
    private $dbname = "kevins_webshop";

    public function __construct() {
    try {
        $this->pdo = new PDO($this->connstring, $this->username, $this->password);
        $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    }

    private function prepareAndBind($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        foreach($params as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        return $stmt;
    }

    public function createRow($sql, $params) {
        $this->prepareAndBind($sql, $params);
        return $this -> pdo -> LastInsertId();
    }
  
    public function readOneRow($sql, $params) {
        $stmt = $this -> prepareAndBind($sql, $params);
        return $stmt->fetch();
    }
  
    public function readMultipleRows($sql, $params) {
        $stmt = $this -> prepareAndBind($sql, $params);
        $results = $stmt->fetchAll();
        $array = array();
            foreach ($results as $result) {
                $array[$result->id] = $result;
            }
        return $array;
    }
  
    public function updateRow($sql, $params) {
        $this -> prepareAndBind($sql, $params);
    }
  
    public function deleteRow($sql, $params) {
        $this -> prepareAndBind($sql, $params);
    }
}

?>