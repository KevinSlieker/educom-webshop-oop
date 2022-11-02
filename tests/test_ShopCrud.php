<?php
include_once('../crud/Crud.php');
include_once('../crud/ShopCrud.php');
$crud = new Crud();
$crud = new ShopCrud($crud);
//$crud->createUser("testcreateUser", "testcreateUser@test.com", "testcreateUser123");
print_r($crud->readAllProducts());
//$crud->updateUser(15, "testupdateUser2", "testupdateUser2@test.com", "testupdateUser123");
//$crud->deleteUser(13);
?>