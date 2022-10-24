<?php

function showShoppingcartHead(){
    echo 'Shoppingcart';
}

function showShoppingcartHeader(){
    echo 'Shoppingcart';
}

function showShoppingcartContent($data){
    echo '<div class="products">';
    if (!empty($data['shoppingcartproducts'])){
        foreach($data['shoppingcartproducts'] as $product) {  // echo '<p> ID:' . $productId . '</p>';
            echo '<div class="product"><a href="index.php?page=detail&id=' . $product['productId'] . '">';
            echo '<h2>' . $product['name'] . '</h2>';
            echo '<img src="Images/' . $product['filename_img'] . '" alt="' . $product['name'] . '" width="60" height="80"><br></a>' . PHP_EOL;
            echo '<div class="amount">';
            echo '<p4> Hoeveelheid: ';
            addAction('shoppingcart', 'addToShoppingcart', "+", $product['productId'], $product['name'], 1);
            echo $product['quantity'];
            addAction('shoppingcart', 'addToShoppingcart', "-", $product['productId'], $product['name'], -1);
            echo '</p4></div><br>' . PHP_EOL;
            echo '<p4> Subtotaal: &euro;' . $product['subtotal'] . ' </p4>';
            addAction('shoppingcart', 'removeFromShoppingcart', "Remove from shoppingcart", $product['productId'], $product['name'], 0);
            echo '</div>';
        }
        echo '<p4>Totaal: &euro;' . $data['total'] .  '</p4>';
        addAction('home','order', "Order");
    } else {
        echo '<p4>Je shoppingcart is nog leeg.</p4>';
    }
    echo '</div>'; 
}

?>