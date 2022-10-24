<?php

function connectDatabase(){

    $servername = "127.0.0.1";
    $username = "Kevins_WebShopUser";
    $password = "GebruikerWebShop";
    $dbname = "kevins_webshop";

// Create connection

    $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection

    if (!$conn) {
        throw new Exception("Cannot connect with the database." . mysqli_connect_error());
    }
    return $conn;
}

function closeDatabase($conn){
    mysqli_close($conn);
}

function saveUser($email,$name,$password) {
    $conn = connectDatabase();
    try {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);        

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
        if (!mysqli_query($conn, $sql)) {
            throw new Exception("Query failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
    }
 // waar moet de catch nu en hoe zit het dan met all mijn errers voor fout email en password?
    finally {
        closeDatabase($conn);
    }
} 

function findUserByEmail($email){
    $conn = connectDatabase();
    $user = NULL;
    try {
        $email = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("Query failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
        $user = mysqli_fetch_assoc($result);
        return $user;
    }
    finally {
        closeDatabase($conn);
    }
}

function getAllProducts(){
    $conn = connectDatabase();
    $products = NULL;
    try {
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("getAllProducts failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0 ) {
            while($row = mysqli_fetch_assoc($result)){
                $products [$row['id']] = $row;
            }
        }
        return $products;
    }
    finally{
        closeDatabase($conn);
    }
}

function findProductById($productId){
    $conn = connectDatabase();
    $product = Null;
    try {
        $sql = "SELECT * FROM products WHERE id = " . $productId . "";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("findProductById failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0 ){
            $product = mysqli_fetch_assoc($result);
        }
        return $product;
    }
    finally{
        closeDatabase($conn);
    }
}

function saveOrder($user_id, $shoppingcartproducts){
    $conn = connectDatabase();

    try{
        mysqli_autocommit($conn,FALSE); // transactie starten zodat het alleen doorgaat als alles goed gaat
        $sql = "INSERT INTO orders (user_id, `date`) VALUE ('$user_id', CURRENT_DATE())";
        $result = mysqli_query($conn, $sql);
        if ($result == false) {
            throw new Exception("saveOrder failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }

        $oderId = mysqli_insert_id($conn);

        foreach($shoppingcartproducts as $product){
            $sql =  "INSERT INTO product_orders (order_id, product_id, quantity, price) VALUE ('$oderId', '" . $product['productId'] . "', '" . $product['quantity'] . "', '" . $product['price'] . "')";
            $result = mysqli_query($conn, $sql);
            if ($result == false) {
                throw new Exception("saveOrder failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
            }
        }
        if (!mysqli_commit($conn)){ //transactie stoppen als er ergens iets verkeert is gegaan en dan een exception gooien
            throw new Exception("saveOrder commit failed, SQL: " . $sql . "Error: " . mysqli_error($conn));
        }
    } catch (Exception $e) { //transactie ongedaan maken als er ergens iets is misgegaan en de exception weer door gooien zodat de uitgelezen kan worden
        mysqli_rollback($conn);
        throw $e;
    }
    finally{
        closeDatabase($conn);    
    }
}

?>