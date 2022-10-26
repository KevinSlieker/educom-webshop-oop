<?php 
    require_once 'product_doc.php';
   
    class DetailDoc extends ProductDoc 
    { 
        
        protected function showHead(){
            echo $this->data['product']['name'];
        }

        
        protected function showHeader(){
            echo $this->data['product']['name'];
        }

        
        protected function mainContent() {
            echo '<div class="detail">';
            echo '<h2>' . $this->data['product']['name'] . '</h2>';
            echo '<img src="Images/' . $this->data['product']['filename_img'] . '" alt="' . $this->data['product']['name'] . '" width="150 height="300"><br><br>';
            echo '<p4>Bechrijving: ' . $this->data['product']['description'] . '</p4><br><br>';
            echo '<p5>Prijs: &euro;' . $this->data['product']['price'] . '</p5></a>';
            $this->addAction('webshop', 'addToShoppingcart', "Add to shoppingcart", $this->data['product']['id'], $this->data['product']['name'], 1);
            echo '</div>';  
        }
    }
?>