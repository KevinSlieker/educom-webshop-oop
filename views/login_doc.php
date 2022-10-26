<?php 
    require_once 'forms_doc.php';
   
    class LoginDoc extends FormsDoc 
    { 
        
        protected function showHead(){
            echo 'Login';
        }

        
        protected function showHeader(){
            echo 'Login';
        }

        
        protected function mainContent() {
            $this->showFormStart();
            $this->showFormSectionStart("info");
            $this->showFormItem("email", "email", "Email:", "Doe@gmail.com");
            $this->showFormItem("password", "password", "Wachtwoord:", "Wachtwoord123");
            $this->showFormSectionEnd();
            $this->showFormEnd("login", "Login");
        }
    }
?>