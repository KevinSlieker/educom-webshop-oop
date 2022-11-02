<?php
include_once('../crud/Crud.php');
$crud = new Crud();
$sql = "kfcuktyf";
// $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";   WHERE id = :id
// $sql = "UPDATE users SET password = :newPassword WHERE id = :id";        "email" => 'crudtest@test.nl', "password" => 'crudtest1234'  "id" => '8', "id" => '1'
$params = array();
try {
$result = $crud->readMultipleRows($sql, $params);
var_dump($result);
}
catch (PDOException $e) {
    echo "test failed: " . $e->getMessage();
}
?>