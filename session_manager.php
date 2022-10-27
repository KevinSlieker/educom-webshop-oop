<?php

// class van maken en dan elke functie public maken.

class SessionManager{

    public function doLoginUser($name, $user_id) {
        $_SESSION['login'] = $name;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['shoppingcart'] = array();  // productid en quantity
    }
    
    public function isUserLoggedIn() {
        return isset($_SESSION['login']);
    }
    
    public function getLoggedInUserName() {
        return $_SESSION['login'];
    }
    
    public function doLogoutUser() {
        unset($_SESSION['login']);
        unset($_SESSION['user_id']);
    }

    public function getShoppingcart(){
    return $_SESSION['shoppingcart'];
    }

    public function addToShoppingcart($productId, $quantity){
    $_SESSION['shoppingcart'][$productId] = $quantity;
    }

    public function removeFromShoppingcart($productId){
    unset($_SESSION['shoppingcart'][$productId]);
    }

    public function emptyShoppingcart(){
        $_SESSION['shoppingcart'] = array();
    }

    public function getUser_Id() {
        return $_SESSION['user_id'];
    }
}
?>