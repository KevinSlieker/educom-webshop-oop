<?php
  include_once "C:/Bitnami/wampstack-8.1.9-0/apache2/htdocs/educom-webshop-oop/views/about_doc.php";

  $data = array ( 'page' => 'about', 'menu' => array('eerste' => 'Eerste', 'tweede' => 'Tweede') );

  $view = new AboutDoc($data);
  $view  -> show();
?>