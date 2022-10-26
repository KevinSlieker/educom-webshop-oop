<?php 
    require_once 'basic_doc.php';
   
    class AboutDoc extends BasicDoc 
    {      

        // Override function from basicDoc
        protected function showHead(){
            echo 'About';
        }

        // Override function from basicDoc
        protected function showHeader(){
            echo 'About';
        }

        // Override function from basicDoc
        protected function mainContent() {
            echo '	<div class="aboutme">
            <p1>
              Mijn naam is Keivn Slieker. Ik ben 22 jaar en woon thuis. Ik heb ook een hond.
            </p1>
          
            <p2>
              Ik heb net mijn opleiding afgerond.
            </p2>
          
            <p3>
              Ik heb ook een aantal hobbies. Namelijk:
              <ul>
                <li> Gamen </li>
                <li> duiken </li>
                <li> Magic the gathering </li>
              </ul>
              <br>
            </p3>
          </div>';
        }
    }
?>