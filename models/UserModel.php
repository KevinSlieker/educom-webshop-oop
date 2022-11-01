<?php

define("RESULT_OK", 0);
define("RESULT_WRONG_PASSWORD", -1);
define("RESULT_WRONG_EMAIL", -2);

class UserModel extends PageModel {

    public $email = '';
    public $emailErr = '';
    public $name = '';
    public $nameErr = '';
    public $password = '';
    public $passwordErr = '';
    public $passwordrepeat = '';
    public $passwordrepeatErr = '';
    public $preamble = '';
    public $preambleErr = '';
    public $communication = '';
    public $communicationErr = '';
    public $phonenumber = '';
    public $phonenumberErr = '';
    public $input = '';
    public $inputErr = '';
    public $genericErr = NULL;
    public $result = '';

    
    //...

    private $user_id = 0;
    public $valid = false;

    

    public function __construct($pageModel) {
      PARENT::__construct($pageModel);
    }

    public function test_input($data) {
    $data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
    }	

    protected function getCleanPostVar($key, $default = ''){
        return $this->test_input($this->getPostVar($key, $default));
    }

    public function validateLogin() {
        if ($this->isPost) {
            //$this->email = $this->test_input($this->getPostVar('email'));
            $this->email = $this->getCleanPostVar('email');
            if (empty($this->email)) {
                $this->emailErr = "Email is verplicht.";
            } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->emailErr = "Ongeldig email.";
            }
    
            $this->password = $this->getCleanPostVar('password');
            if (empty($this->password)) {
                $this->passwordErr = "Wachtwoord is verplicht.";
            }
    
            if (empty($this->emailErr) && empty($this->passwordErr)) {
                try {
                    $this->authenticate = $this->authenticateUser($this->email, $this->password);
                    switch($this->result) {
                        case RESULT_OK:
                            $this->valid = TRUE;
                            $this->name = $this->user['name'];
                            $this->user_id = $this->user['id'];
                            break;
                        case RESULT_WRONG_PASSWORD:
                            $this->passwordErr = "Verkeerd wachtwoord.";
                            break;
                        case RESULT_WRONG_EMAIL:
                            $this->emailErr = "Email is onbekend.";
                            break;
                    }
                } catch (Exception $e) {
                    $this->genericErr = "Er is een technisch probleem opgetreden.";
                    logToServer("authentication failed: ".$e->getMessage());
                }
                }
                
            }
    }

    private function authenticateUser() {
       require_once "db_repository.php";
       $user = findUserByEmail($this->email);
        if (empty($user)) {
             return $this->result = RESULT_WRONG_EMAIL;
        }
        if ($user['password'] != $this->password) {
            return $this->result = RESULT_WRONG_PASSWORD;
        }
        $this->user = $user;
        return $this->result = RESULT_OK;
    }

    public function doLoginUser() {
        $this->sessionManager->doLoginUser($this->name, $this->user_id);
        $this->genericErr = "Login successvol";
        // $this->errors['genericError'] = "Login successvol";
    }

    public function doLogoutUser() {
        $this->sessionManager->doLogoutUser($this->name, $this->user_id);
        $this->genericErr = "Logout successvol";
    }


    function validateContact() {    
        if ($this->isPost) {
            $this->name = $this->getCleanPostVar('name');
            if (empty($this->name)) {
                $this->nameErr = "Naam is verplicht.";
            } else if (!preg_match("/^[a-zA-Z-' ]*$/", $this->name)) {
                    $this->nameErr = "Alleen letters en spaties zijn toegestaan.";
            }
    
            $this->email = $this->getCleanPostVar('email');
            if (empty($this->email)) {
                $this->emailErr = "Email is verplicht.";
            } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $this->emailErr = "Ongeldig email.";
            }
    
            $this->communication = $this->getCleanPostVar('communication');
            if (empty($this->communication)) {
                $this->communicationErr = "Communicatievoorkeur is verplicht.";
            }
    
            $this->phonenumber = $this->getCleanPostVar('phonenumber');
            if (empty($this->phonenumber)) {
                $this->phonenumberErr = "Telefoonnummer is verplicht.";
            } else if (!preg_match("/^0([0-9]{9})$/", $this->phonenumber)) {
                    $this->phonenumberErr = "Vul geldig telefoonnummer in.";
            }
    
            $this->preamble = $this->getCleanPostVar('preamble');
            if (empty($this->preamble)) {
                $this->preambleErr = "Aanhef is verplicht.";
            }
    
            $this->input = $this->getCleanPostVar('input');
            if (empty($this->input)) {
                $this->inputErr = "";
            }
    
            if (empty($this->nameErr) && empty($this->emailErr) && empty($this->communicationErr) && empty($this->phonenumberErr) && empty($this->preambleErr) && empty($this->inputErr)) {
                $this->valid = true;
            }
    
    
        }
    }

    public function validateRegister() {
        if ($this->isPost) {
            $this->name = $this->getCleanPostVar('name');
            if (empty($this->name)) {
                $this->nameErr = "Naam is verplicht.";
            } else if (!preg_match("/^[a-zA-Z-' ]*$/", $this->name)) {
                    $this->nameErr = "Alleen letters en spaties zijn toegestaan.";
            }
    
            $this->email = $this->getCleanPostVar('email');
            if (empty($this->email)) {
                $this->emailErr = "Email is verplicht.";
            } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $this->emailErr = "Ongeldig email.";
            }
    
            $this->password = $this->getCleanPostVar('password');
            if (empty($this->password)) {
                $this->passwordErr = "Wachtwoord is verplicht.";
            }
    
            $this->passwordrepeat = $this->getCleanPostVar('passwordrepeat');
            if (empty($this->passwordrepeat)) {
                $this->passwordrepeatErr = "Herhaal wachtwoord is verplicht.";
            } else if ($this->password !== $this->passwordrepeat) {
                $this->passwordrepeatErr = "Herhaal wachtwoord komt niet over een met wachtwoord.";
            }
            
            if (empty($this->nameErr) && empty($this->emailErr) && empty($this->passwordErr) && empty($this->passwordrepeatErr)) {
                try {
                    if (empty($this->doesEmailExist($this->email))) {
                        $this->valid = true;
                    } else {
                        $this->emailErr = "Email is al in gebruik.";
                    }
                } catch (Exception $e) {
                    $this->genericErr = "Er is een technisch probleem opgetreden.";
                    logToServer("authentication failed: ".$e->getMessage());
                }
            }
        }
    }

    public function doesEmailExist(){
        require_once "db_repository.php";
        $this->user = findUserByEmail($this->email);
        if (empty($this->user)) {
            return FALSE;
        } else {
        return TRUE;
        }
    }
    
    public function storeUser(){
        require_once "db_repository.php";
        saveUser($this->email,$this->name,$this->password);
    }
}


?>