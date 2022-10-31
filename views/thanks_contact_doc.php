<?php 
    require_once 'forms_doc.php';
   
	define("PREAMBLE", array("mr" => "Meneer", "mrs" => "Mevrouw"));
	define("COMMUNICATION", array("email" => "Email", "phone" => "Telefoon"));

    class ThanksContactDoc extends FormsDoc 
    { 
        
        protected function showHead(){
            echo 'Contact';
        }

        
        protected function showHeader(){
            echo 'Contact';
        }

        

        
        protected function mainContent() {
            echo '<p class="thanks"> Bedankt voor het invullen van het contactformulier. </p>
            <br>
            <h3> Jouw gegevens:</h3>';
            echo 'Aanhef: ' . PREAMBLE[$this->model->preamble] . PHP_EOL;
            echo "<br>";
            echo 'Naam: ' . $this->model->name  . PHP_EOL;
            echo "<br>";
            echo 'Email: ' .  $this->model->email . PHP_EOL;
            echo "<br>";
            echo 'Voorkeur communicatie: ' . COMMUNICATION[$this->model->communication] . PHP_EOL;
            echo "<br>";
            echo 'Telefoonnummer: ' . $this->model->phonenumber . PHP_EOL;
            echo "<br>";
            echo 'Text: ' . $this->model->input . PHP_EOL;
        }
    }
?>