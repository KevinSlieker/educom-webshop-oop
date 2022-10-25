<?php
class HtmlDoc 
{ 

   private   function beginDoc() {
        echo '<!doctype html> 
        <html>';
   } 
   private   function beginHead() {
        echo '<head>';
   } 
   protected function headContent() {
    echo '<title>Test</title>';
   } 
   private   function endHead() {
        echo '</head>';
   } 
   private   function beginBody() {
        echo '<body>';
   } 
   protected function bodyContent() {
        echo '<h1>Test</h1>';
   } 
   private   function endBody() {
        echo '</body>';
   } 
   private   function endDoc() {
        echo '</html>';
   } 

   public    function show() 
   { 
       $this->beginDoc(); 
       $this->beginHead(); 
       $this->headContent(); 
       $this->endHead(); 
       $this->beginBody(); 
       $this->bodyContent(); 
       $this->endBody(); 
       $this->endDoc(); 
   }     
} 
?>