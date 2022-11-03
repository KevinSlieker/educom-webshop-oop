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
    public $shoppingcartproducts = array();
    public $total = '';
    public $shoppingcart = '';
    public $shoppingcartproduct = '';
    public $subtotal = '';
    public $canOrder = FALSE;
    public $cart = array();
    //public $detail_id = '';

    public function __construct($pageModel, $shopcrud) {
        PARENT::__construct($pageModel);
        $this->crud = $shopcrud;


        //$this->detail_id = $this->getUrlVar("id");
    }

    public function createMenu(){
        $this->canOrder = $this->sessionManager->isUserLoggedIn();
        $this->cart = $this->sessionManager->getShoppingcart();
        parent::createMenu();
    }


    function getWebshopProducts() {
        $this->products = array();
        $this->genericErr = NULL;
        try {
             $this->products = $this->crud->readAllProducts();
        }
        catch (Exception $e) {
             $this->genericErr = "Sorry, kan geen producten laten zien op dit moment.";  // <-- foutmelding voor de user
             logToServer("GetAllProducts failed  " . $e -> getMessage() );
        } 
         return array("products" => $this->products, "genericErr" => $this->genericErr);
    }
    
    
    
    function getProductDetails($productId) {
        $this->product = NULL;
        $this->genericErr = NULL;
        try {
             $this->product = $this->crud->readProductById($productId);
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
                  //print_r($this->user_id);
                  $this->getShoppingcartProducts(); 
                  $this->storeOrder();
                  break;
        }
   }
   
   function storeOrder() {
        $this->genericErr = NULL;
        try{
        $this->crud->createOrder($this->user_id, $this->shoppingcartproducts);
        $this->sessionManager->emptyShoppingcart();
        }     catch (Exception $e) {
             $this->genericErr = "Sorry, kan de bestelling niet verwerken.";  // <-- foutmelding voor de user
             logToServer("saveOrder failed  " . $e -> getMessage() );
        } 
   }
   
   
   
   function getShoppingcartProducts() {
        $this->shoppingcartproducts = array();
        $this->total = 0;
        $this->genericErr= NULL;
        //print_r($this->user_id);
        try {
             $shoppingcart = $this->sessionManager->getShoppingcart();
             //var_dump($shoppingcart);
             $products = $this->crud->readAllProducts();
             //var_dump($products);
   
             foreach ($shoppingcart as $productId => $quantity) {
                  $product = $this->getArrayVar($products, $productId, NULL);
                  //var_dump($product);
             
             $subtotal = number_format((float)($quantity * $product->price), 2);
             $shoppingcartproduct = array ('productId' => $productId, 'quantity' => $quantity, 'subtotal' => $subtotal, 
             'price' => $product->price, 'name' => $product->name, 'filename_img' => $product->filename_img);
             $this->shoppingcartproducts[$shoppingcartproduct['productId']] = $shoppingcartproduct;
             //var_dump($shoppingcartproduct);
             $this->total += $subtotal;
             }
             //print_r($this->shoppingcartproducts);
             //var_dump($this->shoppingcartproducts);
        }     catch (Exception $e) {
             $this->genericErr = "Sorry, kan geen producten laten zien op dit moment.";  // <-- foutmelding voor de user
             logToServer("GetAllProducts failed  " . $e -> getMessage() );
        }
   }
}

?>