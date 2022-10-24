<?php

function showRegisterHead(){
    echo "Register";
}

function showRegisterHeader() {
    echo "Register";
}


function showRegisterForm($data) {
showFormStart();
showFormSectionStart("info");
showFormItem("name", "name", "Naam:", $data, "John");
showFormItem("email", "email", "Email:", $data, "Doe@gmail.com");
showFormItem("password", "password", "Wachtwoord:", $data, "Wachtwoord123");
showFormItem("passwordrepeat", "password", "Herhaal wachtwoord:", $data, "Wachtwoord123");
showFormSectionEnd();
showFormEnd("register", "Register");
}
?>