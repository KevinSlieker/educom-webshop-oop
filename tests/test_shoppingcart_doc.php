<?php
  include_once "C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/views/shoppingcart_doc.php";

session_start();

  require_once('C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/session_manager.php');

    //$_SESSION['login'] = "test";  /// om sessie in gaan(ingelogd zijn)

  //unset($_SESSION['login']);  /// om uit de sessie te gaan(uigelogd zijn)

    $product = array("name" => "Island", "productId" => "1","quantity" => "1","subtotal" => "1.00", "description" => "Een basic full alt Island van de Zendikar set.", "price" => "1.00", "filename_img" => "island.jpg");

    function getArrayVar($array, $key, $default='') {  
    return isset($array[$key]) ? $array[$key] : $default; 
    } 

    $data = array ( 'page' => 'contact', 'menu' => array('home' => 'Home', 'tweede' => 'Tweede'),
                  'preambleErr' => "test", 'nameErr' => "", 'emailErr' => "", 'communicationErr' => "", 'phonenumberErr' => "", 'inputErr' => "",
                  'preamble' => "", 'name' => "", 'email' => "", 'communication' => "", 'phonenumber' => "", 'input' => "",
                  'passwordErr' => "test", 'passwordrepeatErr' => "", 'password' => "", 'passwordrepeat' => "",
                  'shoppingcartproducts' => array($product, $product), 'total' => '2.00',
                  $valid = false);


    

    var_dump($data);

  $view = new ShoppingcartDoc($data);
  $view  -> show();
?>