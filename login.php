<?php

function showLoginHead(){
    echo "Login";
}

function showLoginHeader() {
    echo "Login";
}


function showLoginForm($data) {
showFormStart();
showFormSectionStart("info");
showFormItem("email", "email", "Email:", $data, "Doe@gmail.com");
showFormItem("password", "password", "Wachtwoord:", $data, "Wachtwoord123");
showFormSectionEnd();
showFormEnd("login", "Login");
}


?>