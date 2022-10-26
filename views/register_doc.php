<?php 
    require_once 'forms_doc.php';
   
    class RegisterDoc extends FormsDoc 
    { 
        
        protected function showHead(){
            echo 'Register';
        }

        
        protected function showHeader(){
            echo 'Register';
        }

        
        protected function mainContent() {
            $this->showFormStart();
            $this->showFormSectionStart("info");
            $this->showFormItem("name", "name", "Naam:", "John");
            $this->showFormItem("email", "email", "Email:", "Doe@gmail.com");
            $this->showFormItem("password", "password", "Wachtwoord:", "Wachtwoord123");
            $this->showFormItem("passwordrepeat", "password", "Herhaal wachtwoord:", "Wachtwoord123");
            $this->showFormSectionEnd();
            $this->showFormEnd("register", "Register");
        }
    }
?>