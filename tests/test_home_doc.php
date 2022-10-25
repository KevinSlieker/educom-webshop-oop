<?php
  include_once "C:/Bitnami/wampstack-8.1.9-0/apache2/htdocs/educom-webshop-oop/views/home_doc.php";

  $data = array ( 'page' => 'home', 'menu' => array('eerste' => 'Eerste', 'tweede' => 'Tweede') );

  $view = new HomeDoc($data);
  $view  -> show();
?>