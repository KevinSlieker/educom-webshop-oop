<?php

function showWebshopHead(){
    echo "Webshop";
}

function showWebshopHeader() {
    echo "Webshop";
}

function showWebshopContent($data) {
    echo '<div class="products">';
    foreach($data['products'] as $product) {
    echo '<div class="product"><a href="index.php?page=detail&id=' . $product['id'] . '">';
    echo '<h2>' . $product['name'] . '</h2>';
    echo '<img src="Images/' . $product['filename_img'] . '" alt="' . $product['name'] . '" width="60" height="80"><br>';
    echo '<p4>Id: ' . $product['id'] . '</p4><br>';
    echo '<p5>Prijs: &euro;' . $product['price'] . '</p5></a>';
    addAction('webshop', 'addToShoppingcart', "Add to shoppingcart", $product['id'], $product['name'], 1);
    echo '</div>'. PHP_EOL;
    }
    echo '</div>';  
}
?>