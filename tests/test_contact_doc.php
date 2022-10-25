<?php
  include_once "C:/Bitnami/wampstack-8.1.9-0/apache2/htdocs/educom-webshop-oop/views/contact_doc.php";

  $data = array ( 'page' => 'contact', 'menu' => array('eerste' => 'Eerste', 'tweede' => 'Tweede'),
                 'preamble' => 'mrs', 'preambleErr' => 'een error', 
                'name' => 'Karel', 'nameErr' => 'naamErr' );

  $view = new ContactDoc($data);
  $view  -> show();
?>