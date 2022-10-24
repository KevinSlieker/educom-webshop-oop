<?php

	define("PREAMBLE", array("mr" => "Meneer", "mrs" => "Mevrouw"));
	define("COMMUNICATION", array("email" => "Email", "phone" => "Telefoon"));

function showContactHead(){
    echo "Contact";
}

function showContactHeader() {
    echo "Contact";
}

function showContactForm($data) {
showFormStart();
showFormSectionStart("preamble");
showFormItem("preamble", "select", "Aanhef:", $data, NULL, array('mr'  => "Meneer", 'mrs' => "Mevrouw"));
showFormSectionEnd();
showFormSectionStart("info");
showFormItem("name", "text", "Naam:", $data, "John");
showFormItem("email", "email", "Email:", $data, "Doe@gmail.com");
showFormItem("phonenumber", "tel", "Telefoonnummer:", $data, "0612345678");
showFormSectionEnd();
showFormSectionStart("communication");
showFormItem("communication", "radio", "Voorkeur communicatie:", $data, NULL, array('email'  => "Email", 'phone' => "Telefoon"));
showFormSectionEnd();
showFormSectionStart("input");
showFormItem("input", "textarea", "Text veld:", $data, "Vul hier overige informatie die van belang is in.", NULL, "8", "30");
showFormSectionEnd();
showFormEnd("contact", "Submit");
}

function showContactThanks($data){
	echo '<p class="thanks"> Bedankt voor het invullen van het contactformulier. </p>
	<br>
	<h3> Jouw gegevens:</h3>';
	echo 'Aanhef: ' . PREAMBLE[$data['preamble']] . PHP_EOL;
	echo "<br>";
	echo 'Naam: ' . $data['name']  . PHP_EOL;
	echo "<br>";
	echo 'Email: ' .  $data['email'] . PHP_EOL;
	echo "<br>";
	echo 'Voorkeur communicatie: ' . COMMUNICATION[$data['communication']] . PHP_EOL;
	echo "<br>";
	echo 'Telefoonnummer: ' . $data['phonenumber'] . PHP_EOL;
	echo "<br>";
	echo 'Text: ' . $data['input'] . PHP_EOL;
}

?>