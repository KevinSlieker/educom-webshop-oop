<?php

class ShopModel extends PageModel {


  
    public $products = '';
    public $genericErr = NULL;
    public $data = '';
    public $product = array();
    public $action = '';
    public $productId = '';
    public $quantity = '';
    private $user_id = 0;
    public $shoppingcartproducts = '';
    public $total = '';
    public $shoppingcart = '';
    public $shoppingcartproduct = '';
    public $subtotal = '';
    public $canOrder = FALSE;
    public $cart = array();
    //public $detail_id = '';

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);


        //$this->detail_id = $this->getUrlVar("id");
    }

    public function createMenu(){
        $this->canOrder = $this->sessionManager->isUserLoggedIn();
        $this->cart = $this->sessionManager->getShoppingcart();
        parent::createMenu();
    }


    function getWebshopProducts() {
        require_once('db_repository.php');
        $this->products = array();
        $this->genericErr = NULL;
        try {
             $this->products = getAllProducts();
        }
        catch (Exception $e) {
             $this->genericErr = "Sorry, kan geen producten laten zien op dit moment.";  // <-- foutmelding voor de user
             logToServer("GetAllProducts failed  " . $e -> getMessage() );
        } 
         return array("products" => $this->products, "genericErr" => $this->genericErr);
    }
    
    
    
    function getProductDetails($productId) {
        require_once('db_repository.php');
        $this->product = NULL;
        $this->genericErr = NULL;
        try {
             $this->product = findProductById($productId);
        }
        catch (Exception $e) {
             $this->genericErr = "Sorry, kan geen details laten zien op dit moment.";  // <-- foutmelding voor de user
             logToServer("findProductById failed  " . $e -> getMessage() );
        } 
         return array("product" => $this->product, "genericErr" => $this->genericErr);
    
    }


    function handleActions(){ ///data verander (kan weg)
        $this->action = $this->getPostVar("action");
        switch($this->action) {
             case "addToShoppingcart":
                  $this->productId = $this->getPostVar("id");
                  $this->quantity = $this->getPostVar("quantity");
                  $this->sessionManager->addToShoppingcart($this->productId, $this->quantity);
                  break;
             case "removeFromShoppingcart":
                  $this->productId = $this->getPostVar("id");
                  $this->sessionManager->removeFromShoppingcart($this->productId);
                  break;
             case "order":
                  $this->user_id = $this->sessionManager->getUser_Id();
                  $this->getShoppingcartProducts(); 
                  $this->storeOrder();
                  break;
        }
   }
   
   function storeOrder() {
        require_once('db_repository.php');
        $this->genericErr = NULL;
   
        try{
        saveOrder($this->user_id, $this->shoppingcartproducts);
        $this->sessionManager->emptyShoppingcart();
        }     catch (Exception $e) {
             $this->genericErr = "Sorry, kan de bestelling niet verwerken.";  // <-- foutmelding voor de user
             logToServer("saveOrder failed  " . $e -> getMessage() );
        } 
   }
   
   
   
   function getShoppingcartProducts() {
        require_once('db_repository.php');
        $this->shoppingcartproducts = array();
        $this->total = 0;
        $this->genericErr= NULL;
        try {
             $shoppingcart = $this->sessionManager->getShoppingcart();
             $products = getAllProducts();
   
             foreach ($shoppingcart as $productId => $quantity) {
                  $product = $this->getArrayVar($products, $productId, NULL);
             
             $subtotal = number_format((float)($quantity * $product['price']), 2);
             $shoppingcartproduct = array ('productId' => $productId, 'quantity' => $quantity, 'subtotal' => $subtotal, 
             'price' => $product['price'], 'name' => $product['name'], 'filename_img' => $product['filename_img']);
             $this->shoppingcartproducts[] = $shoppingcartproduct;
             $this->total += $subtotal;
             }
        }     catch (Exception $e) {
             $this->genericErr = "Sorry, kan geen producten laten zien op dit moment.";  // <-- foutmelding voor de user
             logToServer("GetAllProducts failed  " . $e -> getMessage() );
        }
   }
}

?>