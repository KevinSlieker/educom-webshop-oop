<?php
  include_once "C:/Bitnami/wampstack-8.1.9-0/apache2/htdocs/educom-webshop-oop/views/basic_doc.php";

  $data = array ( 'page' => 'basic', 'menu' => array('eerste' => 'Eerste', 'tweede' => 'Tweede') );

  $view = new BasicDoc($data);
  $view  -> show();
?>