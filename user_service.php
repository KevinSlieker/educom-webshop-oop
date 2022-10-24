<?php
    // Enummerator (nummers staan er omdat het iets moet aangeven. negatief vaak voor slecht en positief voor goed)
    define("RESULT_OK", 0);
    define("RESULT_WRONG_PASSWORD", -1);
    define("RESULT_WRONG_EMAIL", -2);

function authenticateUser($email, $password) {
	$user = findUserByEmail($email);
    if (empty($user)) {
         return array("result" => RESULT_WRONG_EMAIL, "user" => $user);
    }
    if ($user['password'] != $password) {
        return array("result" => RESULT_WRONG_PASSWORD, "user" => $user);
    }
    return array("result" => RESULT_OK, "user" => $user);
}




function doesEmailExist($email){
    $user = findUserByEmail($email);
    if (empty($user)) {
        return FALSE;
    } else {
    return TRUE;
    }
}

function storeUser($email,$name,$password){
    saveUser($email,$name,$password);
}

?>
