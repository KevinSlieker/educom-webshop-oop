<?php 
    require_once 'product_doc.php';
   
    class DetailDoc extends ProductDoc 
    { 
        
        protected function showHead(){
            echo $this->model->product['name'];
        }

        
        protected function showHeader(){
            echo $this->model->product['name'];
        }

        
        protected function mainContent() {
            //var_dump($this->model->product);
            echo '<div class="detail">';
            echo '<h2>' . $this->model->product['name'] . '</h2>';
            echo '<img src="Images/' . $this->model->product['filename_img'] . '" alt="' . $this->model->product['name'] . '" width="150 height="300"><br><br>';
            echo '<p4>Bechrijving: ' . $this->model->product['description'] . '</p4><br><br>';
            echo '<p5>Prijs: &euro;' . $this->model->product['price'] . '</p5></a>';
            $this->addAction('webshop', 'addToShoppingcart', "Add to shoppingcart", $this->model->product['id'], $this->model->product['name'], 1);
            echo '</div>';  
        }
    }
?>