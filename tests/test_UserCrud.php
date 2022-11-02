<?php
include_once('../crud/Crud.php');
include_once('../crud/UserCrud.php');
$crud = new Crud();
$crud = new UserCrud($crud);
//$crud->createUser("testcreateUser", "testcreateUser@test.com", "testcreateUser123");
print_r($crud->readUserByEmail("testcreateUser@test.com"));
//$crud->updateUser(15, "testupdateUser2", "testupdateUser2@test.com", "testupdateUser123");
//$crud->deleteUser(13);
?>