<?php
include_once('../crud/Crud.php');
include_once('../crud/ShopCrud.php');
$crud = new Crud();
$crud = new ShopCrud($crud);
//$crud->createUser("testcreateUser", "testcreateUser@test.com", "testcreateUser123");
$user_id = "25";
//$shoppingcartproduct = array(["productId"] => "1", ["quantity"] => "4", ["subtotal"] => "4.00", ["price"] => "1.00", ["name"] => "Island", ["filename_img"] => "island.jpg");
//$shoppingcartproduct = array( ["productId"] => "2", ["quantity"] => "2", ["subtotal"] => "2.00", ["price"] => "1.00", ["name"] => "Forest", ["filename_img"] => "forest.jpg" );
$shoppingcartproducts = array (array("productId" => "1", "quantity" => "4", "subtotal" => "4.00", "price" => "1.00", "name" => "Island", "filename_img" => "island.jpg"), array("productId" => "2", "quantity" => "2", "subtotal" => "2.00", "price" => "1.00", "name" => "Forest", "filename_img" => "forest.jpg"));
$testen = array (array ("1", "2" =>"abc"), array ("2", 3=>"abc"));
$crud->createOrder($user_id, $shoppingcartproducts);
//$crud->updateUser(15, "testupdateUser2", "testupdateUser2@test.com", "testupdateUser123");
//$crud->deleteUser(13);
?>