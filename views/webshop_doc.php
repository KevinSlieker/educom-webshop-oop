<?php 
    require_once 'product_doc.php';
   
    class WebshopDoc extends ProductDoc 
    { 
        
        protected function showHead(){
            echo 'Webshop';
        }

        
        protected function showHeader(){
            echo 'Webshop';
        }

        
        protected function mainContent() {
            echo '<div class="products">';
            foreach($this->model->products as $product) {
            echo '<div class="product"><a href="index.php?page=detail&id=' . $product['id'] . '">';
            echo '<h2>' . $product['name'] . '</h2>';
            echo '<img src="Images/' . $product['filename_img'] . '" alt="' . $product['name'] . '" width="60" height="80"></a>'. PHP_EOL;
            echo '<div class="text">';
            echo '<div class="id"><p>Id: ' . $product['id'] . '</p></div>'. PHP_EOL;
            echo '<div class="price"><p>Prijs: &euro;' . $product['price'] . '</p></div><br>';
            echo '<div class="addbutton">';
            $this->addAction('webshop', 'addToShoppingcart', "Add to shoppingcart", $product['id'], $product['name'], 1);
            echo '</div></div></div>'. PHP_EOL;
            }
            echo '</div>';  
        }
    }
?>