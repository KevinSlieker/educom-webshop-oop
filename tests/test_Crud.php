<?php
include_once('../crud/Crud.php');
$crud = new Crud();
$sql = "SELECT * FROM users";
// $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";   WHERE id = :id
// $sql = "UPDATE users SET password = :newPassword WHERE id = :id";        "email" => 'crudtest@test.nl', "password" => 'crudtest1234'  "id" => '8', "id" => '1'
$params = array();
$result = $crud->readMultipleRows($sql, $params);
var_dump($result);
?>