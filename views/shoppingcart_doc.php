<?php 
    require_once 'product_doc.php';
   
    class ShoppingcartDoc extends ProductDoc 
    { 
        
        protected function showHead(){
            echo 'Shoppingcart';
        }

        
        protected function showHeader(){
            echo 'Shoppingcart';
        }

        
        protected function mainContent() {
            echo '<div class="products">';
            if (!empty($this->data['shoppingcartproducts'])){
                foreach($this->data['shoppingcartproducts'] as $product) {  // echo '<p> ID:' . $productId . '</p>';
                    echo '<div class="product"><a href="index.php?page=detail&id=' . $product['productId'] . '">';
                    echo '<h2>' . $product['name'] . '</h2>';
                    echo '<img src="Images/' . $product['filename_img'] . '" alt="' . $product['name'] . '" width="60" height="80"></a>' . PHP_EOL;
                    echo '<div class="text">';
                    echo '<div class="amount">';
                    echo '<p> Hoeveelheid:&nbsp;</p>';
                    $this->addAction('shoppingcart', 'addToShoppingcart', "+", $product['productId'], $product['name'], 1);
                    echo $product['quantity'];
                    $this->addAction('shoppingcart', 'addToShoppingcart', "-", $product['productId'], $product['name'], -1);
                    echo '</div>'. PHP_EOL;
                    echo '<div class="subtotal"><p> Subtotaal: &euro;' . $product['subtotal'] . '</p></div><br>';
                    echo '<div class="removebutton">';
                    $this->addAction('shoppingcart', 'removeFromShoppingcart', "Remove from shoppingcart", $product['productId'], $product['name'], 0);
                    echo '</div></div></div>';
                }
                echo '<div class="total">';
                echo '<p>Totaal: &euro;' . $this->data['total'] .  '</p>';
                $this->addAction('home','order', "Order");
                echo '</div>';
            } else {
                echo '<p>Je shoppingcart is nog leeg.</p>';
            }
            echo '</div>'; 
        }
    }
?>