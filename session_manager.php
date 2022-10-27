<?php

// class van maken en dan elke functie public maken.

function doLoginUser($name, $user_id) {
    $_SESSION['login'] = $name;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['shoppingcart'] = array();  // productid en quantity
}
 
function isUserLoggedIn() {
    return isset($_SESSION['login']);
}
 
function getLoggedInUserName() {
     return $_SESSION['login'];
}
 
function doLogoutUser() {
    unset($_SESSION['login']);
    unset($_SESSION['user_id']);
}

function getShoppingcart(){
   return $_SESSION['shoppingcart'];
}

function addToShoppingcart($productId, $quantity){
   $_SESSION['shoppingcart'][$productId] = $quantity;
}

function removeFromShoppingcart($productId){
   unset($_SESSION['shoppingcart'][$productId]);
}

function emptyShoppingcart(){
    $_SESSION['shoppingcart'] = array();
}

function getUser_Id() {
    return $_SESSION['user_id'];
}
?>