<?php 
    require_once 'basic_doc.php';
   
    class HomeDoc extends BasicDoc 
    {      

        // Override function from basicDoc
        protected function showHead(){
            echo 'Home';
        }

        // Override function from basicDoc
        protected function showHeader(){
            echo 'Home';
        }

        // Override function from basicDoc
        protected function mainContent() {
           echo "<p1>Welkom op mijn website. Ik wens je veel leesplezier toe.</p1>";
        }
    }
?>