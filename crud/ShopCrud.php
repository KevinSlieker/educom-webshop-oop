<?php

class ShopCrud {

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function createOrder($user_id, $shoppingcartproducts){
        try {
            $this->pdo->beginTransaction();
            $params = get_defined_vars();
            $sql = "INSERT INTO orders (user_id, `date`) VALUE (:user_id, CURRENT_DATE())";
            $orderId = $this->crud->createRow($sql, $params);
            foreach($shoppingcartproducts as $product){
                $params = array("orderId" => $orderId, "productId" => $product['productId'], "quantity" => $product['quantity'], "price" => $product['price']);
                $sql =  "INSERT INTO product_orders (order_id, product_id, quantity, price) VALUE (:orderId, :productId, :quantity, :price)";
                $this->crud->createRow($sql, $params);
            }
            $this->pdo->commit(); //pdo::commit()
            } 
        catch (PDOException $e) {
            $this->pdo->rollback(); //pdo::rollback()
            throw $e;
        }
    }

    public function readProductById($productId){
        $params = get_defined_vars();        
        $sql = "SELECT * FROM products  WHERE id = :productId";
        return $this->crud->readOneRow($sql, $params);
    }

    public function readAllProducts(){    
        $sql = "SELECT * FROM products";
        return $this->crud->readAllRows($sql);
    }
}

?>