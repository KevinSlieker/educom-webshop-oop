<?php

function findUserByEmail($email){
	$file = fopen('users/users.txt', 'r');
	$user = NULL;
	$line = fgets($file);

    while (!feof($file)) {
        $line = fgets($file);
        $explode = explode('|', $line);
        if ($explode[0] == $email) {
            $user = array("email" => $explode[0], "name"=> $explode[1], "password"=> $explode[2]);
        }
    }
    fclose($file);
    return $user;

}


function saveUser($email,$name,$password) {
    $file = $file = fopen('users/users.txt', 'a');
    $newuser = $email . '|' . $name . '|' . $password;
    fwrite($file, PHP_EOL . $newuser);
    fclose($file);
}

?>
