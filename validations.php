<?php

function validateContact() {
	$preambleErr = $nameErr = $emailErr = $communicationErr = $phonenumberErr = $inputErr = "";
	$preamble = $name = $email = $communication = $phonenumber = $input = "";
	$valid = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = test_input(getPostVar('name'));
		if (empty($name)) {
			$nameErr = "Naam is verplicht.";
		} else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
				$nameErr = "Alleen letters en spaties zijn toegestaan.";
		}

		$email = test_input(getPostVar('email'));
		if (empty($email)) {
			$emailErr = "Email is verplicht.";
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Ongeldig email.";
		}

		$communication = test_input(getPostVar('communication'));
		if (empty($communication)) {
			$communicationErr = "Communicatievoorkeur is verplicht.";
		}

		$phonenumber = test_input(getPostVar('phonenumber'));
		if (empty($phonenumber)) {
			$phonenumberErr = "Telefoonnummer is verplicht.";
		} else if (!preg_match("/^0([0-9]{9})$/", $phonenumber)) {
				$phonenumberErr = "Vul geldig telefoonnummer in.";
		}

		$preamble = test_input(getPostVar('preamble'));
		if (empty($preamble)) {
			$preambleErr = "Aanhef is verplicht.";
		}

		$input = test_input(getPostVar('input'));
		if (empty($input)) {
			$inputErr = "";
		}

		if (empty($nameErr) && empty($emailErr) && empty($communicationErr) && empty($phonenumberErr) && empty($preambleErr) && empty($inputErr)) {
			$valid = true;
		}


	}
	return array("name" => $name, "nameErr" => $nameErr,
	"valid" => $valid,
	"preamble" => $preamble, "preambleErr" => $preambleErr,
	"email" => $email, "emailErr" => $emailErr,
	"communication" => $communication, "communicationErr" => $communicationErr,
	"phonenumber" => $phonenumber, "phonenumberErr" => $phonenumberErr, 
	"input" => $input, "inputErr" => $inputErr);
}

function validateRegister() {
    $nameErr = $emailErr = $passwordErr = $passwordrepeatErr = "";
	$name = $email = $password = $passwordrepeat = "";
	$genericErr = '';
	$valid = false;



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = test_input(getPostVar('name'));
		if (empty($name)) {
			$nameErr = "Naam is verplicht.";
		} else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
				$nameErr = "Alleen letters en spaties zijn toegestaan.";
		}

        $email = test_input(getPostVar('email'));
		if (empty($email)) {
			$emailErr = "Email is verplicht.";
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Ongeldig email.";
		}

        $password = test_input(getPostVar('password'));
		if (empty($password)) {
			$passwordErr = "Wachtwoord is verplicht.";
		}

        $passwordrepeat = test_input(getPostVar('passwordrepeat'));
		if (empty($passwordrepeat)) {
			$passwordrepeatErr = "Herhaal wachtwoord is verplicht.";
		} else if ($password !== $passwordrepeat) {
			$passwordrepeatErr = "Herhaal wachtwoord komt niet over een met wachtwoord.";
		}
		
		if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($passwordrepeatErr)) {
			try {
				if (empty(doesEmailExist($email))) {
					$valid = true;
				} else {
					$emailErr = "Email is al in gebruik.";
				}
			} catch (Exception $e) {
				$genericErr = "Er is een technisch probleem opgetreden.";
				logToServer("authentication failed: ".$e->getMessage());
			}
		}


    }
    

    return array("name" => $name, "nameErr" => $nameErr,
	"valid" => $valid, 'genericErr' => $genericErr,
	"password" => $password, "passwordErr" => $passwordErr,
	"email" => $email, "emailErr" => $emailErr,
	"passwordrepeat" => $passwordrepeat, "passwordrepeatErr" => $passwordrepeatErr);

}

function validateLogin() {
    $emailErr = $passwordErr = "";
	$email = $password = "";
	$valid = false;
    $name = '';
	$user_id = '';
	$genericErr = '';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input(getPostVar('email'));
		if (empty($email)) {
			$emailErr = "Email is verplicht.";
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Ongeldig email.";
		}

        $password = test_input(getPostVar('password'));
		if (empty($password)) {
			$passwordErr = "Wachtwoord is verplicht.";
		}

        if (empty($emailErr) && empty($passwordErr)) {
			try {
				$authenticate = authenticateUser($email, $password);
				switch($authenticate['result']) {
					case RESULT_OK:
						$valid = TRUE;
						$name = $authenticate['user']['name'];
						$user_id = $authenticate['user']['id'];
						break;
					case RESULT_WRONG_PASSWORD:
						$passwordErr = "Verkeerd wachtwoord.";
						break;
					case RESULT_WRONG_EMAIL:
						$emailErr = "Email is onbekend.";
						break;
				}
			} catch (Exception $e) {
				$genericErr = "Er is een technisch probleem opgetreden.";
				logToServer("authentication failed: ".$e->getMessage());
			}
			}
			
		}

    
    return array(
	"valid" => $valid, 'genericErr' => $genericErr,
	"password" => $password, "passwordErr" => $passwordErr,
	"email" => $email, "emailErr" => $emailErr,
    "name" => $name, "user_id" => $user_id);

}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}	

?>