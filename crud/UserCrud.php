<?php

class UserCrud {

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function createUser($name, $email, $password){
        $params = get_defined_vars();
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $this->crud->createRow($sql, $params);
    }

    public function readUserByEmail($email){
        $params = get_defined_vars();        
        $sql = "SELECT * FROM users  WHERE email = :email";
        return $this->crud->readOneRow($sql, $params);
    }

    public function updateUser($id, $name=NULL, $email=NULL, $password=NULL){
        $params = get_defined_vars();
        $toUpdate = "";
        foreach($params as $key => $value){
            if($key !== "id" && $value !== NULL) {
                $toUpdate .= $key . "=:" . $key . ", ";
            }
        }
        $toUpdate = substr($toUpdate, 0, strlen($toUpdate) - 2) . " ";
        $sql = "UPDATE users SET " . $toUpdate  . "WHERE id = :id";
        $this->crud->updateRow($sql, $params);
    }

    public function deleteUser(int $id){
        $params = get_defined_vars();
        $sql = "DELETE FROM users WHERE id=:id";
        $this->crud->deleteRow($sql, $params);
    }
}

?>