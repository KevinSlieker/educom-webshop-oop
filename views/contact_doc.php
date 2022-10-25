<?php 
    require_once 'forms_doc.php';
   
    class ContactDoc extends FormsDoc 
    { 
        
        protected function showHead(){
            echo 'Contact';
        }

        
        protected function showHeader(){
            echo 'Contact';
        }

        
        protected function mainContent() {
                $this->showFormStart();
                $this->showFormSectionStart("preamble");
                $this->showFormItem("preamble", "select", "Aanhef:", options: array('mr'  => "Meneer", 'mrs' => "Mevrouw"));
                $this->showFormSectionEnd();
                $this->showFormSectionStart("info");
                $this->showFormItem("name", "text", "Naam:","John");
                $this->showFormItem("email", "email", "Email:", "Doe@gmail.com");
                $this->showFormItem("phonenumber", "tel", "Telefoonnummer:", "0612345678");
                $this->showFormSectionEnd();
                $this->showFormSectionStart("communication");
                $this->showFormItem("communication", "radio", "Voorkeur communicatie:",  options: array('email'  => "Email", 'phone' => "Telefoon"));
                $this->showFormSectionEnd();
                $this->showFormSectionStart("input");
                $this->showFormItem("input", "textarea", "Text veld:",  "Vul hier overige informatie die van belang is in.", rows:"8", cols: "30");
                $this->showFormSectionEnd();
                $this->showFormEnd("contact", "Submit");
        }
    }
?>