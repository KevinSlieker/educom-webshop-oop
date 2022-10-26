<?php
  include_once "C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/views/webshop_doc.php";

session_start();



  require_once('C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/session_manager.php');
  require_once('C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/validations.php');
  require_once("C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/user_service.php");
  require_once("C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/db_repository.php");
  require_once("C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/forms.php");
  require_once("C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/products_service.php");

    $product = array("name" => "Island", "id" => "1", "description" => "Een basic full alt Island van de Zendikar set.", "price" => "1.00", "filename_img" => "island.jpg");

    function getArrayVar($array, $key, $default='') {  
    return isset($array[$key]) ? $array[$key] : $default; 
    } 

    $data = array ( 'page' => 'contact', 'menu' => array('home' => 'Home', 'tweede' => 'Tweede'),
                  'preambleErr' => "test", 'nameErr' => "", 'emailErr' => "", 'communicationErr' => "", 'phonenumberErr' => "", 'inputErr' => "",
                  'preamble' => "", 'name' => "", 'email' => "", 'communication' => "", 'phonenumber' => "", 'input' => "",
                  'passwordErr' => "test", 'passwordrepeatErr' => "", 'password' => "", 'passwordrepeat' => "",
                  'products' => array($product, $product),
                  $valid = false);


    

    var_dump($data);

  $view = new WebshopDoc($data);
  $view  -> show();
?>