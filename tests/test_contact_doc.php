<?php
  include_once "C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/educom-webshop-oop/views/contact_doc.php";

  $data = array ( 'page' => 'contact', 'menu' => array('eerste' => 'Eerste', 'tweede' => 'Tweede'),
                  'preambleErr' => "test", 'nameErr' => "", 'emailErr' => "", 'communicationErr' => "", 'phonenumberErr' => "", 'inputErr' => "",
                  'preamble' => "", 'name' => "", 'email' => "", 'communication' => "", 'phonenumber' => "", 'input' => "",
                  $valid = false) ;

  $view = new ContactDoc($data);
  $view  -> show();
?>