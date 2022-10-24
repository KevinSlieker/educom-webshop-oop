<?php

function getWebshopProducts() {
    $products = array();
    $genericErr = "";
    try {
         $products = getAllProducts();
    }
    catch (Exception $e) {
         $genericErr = "Sorry, kan geen producten laten zien op dit moment.";  // <-- foutmelding voor de user
         logToServer("GetAllProducts failed  " . $e -> getMessage() );
    } 
     return array("products" => $products, "genericErr" => $genericErr);
}



function getProductDetails($productId) {
    $product = NULL;
    $genericErr = "";
    try {
         $product = findProductById($productId);
    }
    catch (Exception $e) {
         $genericErr = "Sorry, kan geen details laten zien op dit moment.";  // <-- foutmelding voor de user
         logToServer("findProductById failed  " . $e -> getMessage() );
    } 
     return array("product" => $product, "genericErr" => $genericErr);

}

function addAction($nextpage, $action, $button, $productId = NULL, $name = NULL, $addquantity = 0){
     if (isUserLoggedIn()){
          echo '<form action="index.php" method="post">';
          echo '<input type="hidden" name="action" value="' . $action . '">' . PHP_EOL;
          if (!empty($productId)) {
          echo '<input type="hidden" name="id" value="' . $productId . '">' . PHP_EOL;
          }
          if (!empty($name)) {
          echo '<input type="hidden" name="name" value="' . $name . '">' . PHP_EOL;
          }
          echo '<input type="hidden" name="page" value="' . $nextpage . '">' . PHP_EOL;
          if ($addquantity !== 0) {
               $cart = getShoppingcart();
               $quantity = ($addquantity + (float)getArrayVar($cart, $productId, 0));
               echo '<input type="hidden" name="quantity" value="' . $quantity . '">' . PHP_EOL;
               if ($quantity == 0) {
                    echo '<input type="hidden" name="action" value="removeFromShoppingcart">' . PHP_EOL;
               }
          }
          echo '<button>' . $button . '</button>' . PHP_EOL;
          echo '</form>';
     }

}

function handleActions(){
     $data = array();
     $action = getPostVar("action");
     switch($action) {
          case "addToShoppingcart":
               $productId = getPostVar("id");
               $quantity = getPostVar("quantity");
               addToShoppingcart($productId, $quantity);
               break;
          case "removeFromShoppingcart":
               $productId = getPostVar("id");
               removeFromShoppingcart($productId);
               break;
          case "order":
               $user_id = getUser_Id();
               $data = getShoppingcartProducts(); 
               $data = storeOrder($user_id, $data['shoppingcartproducts']);
               break;
     }
     return $data;

}

function storeOrder($user_id, $shoppingcartproducts) {
     $genericErr = '';

     try{
     saveOrder($user_id, $shoppingcartproducts);
     emptyShoppingcart();
     }     catch (Exception $e) {
          $genericErr = "Sorry, kan de bestelling niet verwerken.";  // <-- foutmelding voor de user
          logToServer("saveOrder failed  " . $e -> getMessage() );
     } 
     return array("genericErr" => $genericErr);
}



function getShoppingcartProducts() {
     $shoppingcartproducts = array();
     $total = 0;
     $genericErr= "";
     try {
          $shoppingcart = getShoppingcart();
          $products = getAllProducts();

          foreach ($shoppingcart as $productId => $quantity) {
               $product = getArrayVar($products, $productId, NULL);
          
          $subtotal = number_format((float)($quantity * $product['price']), 2);
          $shoppingcartproduct = array ('productId' => $productId, 'quantity' => $quantity, 'subtotal' => $subtotal, 
          'price' => $product['price'], 'name' => $product['name'], 'filename_img' => $product['filename_img']);
          $shoppingcartproducts[] = $shoppingcartproduct;
          $total += $subtotal;
          }
     }     catch (Exception $e) {
          $genericErr = "Sorry, kan geen producten laten zien op dit moment.";  // <-- foutmelding voor de user
          logToServer("GetAllProducts failed  " . $e -> getMessage() );
     }
     return array ("shoppingcartproducts" => $shoppingcartproducts, "total" => number_format((float)($total), 2), "genericErr" => $genericErr);
}

?>