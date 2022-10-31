<?php

require_once("models/PageModel.php");

class PageController {

    private $model;
    


    
    public function __construct() {
       $this->model = new PageModel(NULL);
    }

    public function handleRequest() {
       $this->getRequest();
       $this->processRequest();
       $this->showResponsePage();
   }

   // from client
   private function getRequest() {
       $this->model->getRequestedPage();
   }
 
 
 
   // business flow code
   private function processRequest() {
       switch($this->model->page) {
       case "login":
            require_once("models/UserModel.php");
            $this->model = new UserModel($this->model);
            $this->model->validateLogin();
            if ($this->model->valid) {
                $this->model->doLoginUser();
                $this->model->setPage("home");
            }
            break;
        case 'logout':
            require_once("models/UserModel.php");
            $this->model = new UserModel($this->model);
            $this->model->doLogoutUser(); 
            $this->model->setPage("home"); 
            break;
        case 'contact':
            require_once("models/UserModel.php");
            $this->model = new UserModel($this->model);
            $this->model->validateContact();
            if ($this->model->valid) {
                $this->model->setPage('thanks');
           }
           break;
        case 'register':
            require_once("models/UserModel.php");
            $this->model = new UserModel($this->model);
            $this->model->validateRegister();
            if ($this->model->valid) {
                try {
                    $this->model->storeUser();
                    $this->model = new UserModel($this->model);
                    $this->model->setPage('login');
                } catch (Exception $e) { // wat met de exceptions?
                    $this->model->genericErr = "Er is een technisch probleem opgetreden.";
                    logToServer("storeUser failed: ".$e->getMessage());
                }
            }
            break;
        case "webshop":
            require_once("models/ShopModel.php");
            $this->model = new ShopModel($this->model);
            $this->model->handleActions();
            $this->model->getWebshopProducts();
            break;
        case "detail":
            require_once("models/ShopModel.php");
            $this->model = new ShopModel($this->model);
            $id = $this->getUrlVar("id");
            $this->model->handleActions();
            $this->model->getProductDetails($id);
            break;
        case "shoppingcart":
            require_once("models/ShopModel.php");
            $this->model = new ShopModel($this->model);
            $this->model->handleActions();
            $this->model->getShoppingcartProducts();
            break;
        case "home":
            require_once("models/ShopModel.php");
            $this->model = new ShopModel($this->model);
            $this->model->handleActions();
            break;
     }
 
   } 
 
   // to client: presentatie laag
   private function showResponsePage() {
       $this->model->createMenu();

       switch($this->model->page) {
        case 'home':
            require_once("views/home_doc.php");
            $view = new HomeDoc($this->model);
            break;
        case 'about':
            require_once("views/about_doc.php");
            $view = new AboutDoc($this->model);
            break;
        case 'contact':
            require_once("views/contact_doc.php");
            $view = new ContactDoc($this->model);
            break;
        case 'thanks':
            require_once("views/thanks_contact_doc.php");
            $view = new ThanksContactDoc($this->model);
            break;
        case 'login':
            require_once("views/login_doc.php");
            $view = new LoginDoc($this->model);
            break;
        case 'register':
            require_once("views/register_doc.php");
            $view = new RegisterDoc($this->model);
            break;
        case 'webshop':
            require_once("views/webshop_doc.php");
            $view = new WebshopDoc($this->model);
            break;
        case 'detail':
            require_once("views/detail_doc.php");
            $view = new DetailDoc($this->model);
            break;
        case 'shoppingcart':
            require_once("views/shoppingcart_doc.php");
            $view = new ShoppingcartDoc($this->model);
            break;
        default:
            var_dump($this->model->page);
       }
       $view->show();
    }

    public function getArrayVar($array, $key, $default='') 
    {  
        return isset($array[$key]) ? $array[$key] : $default; 
    } 


    protected function getUrlVar($key, $default='') 
    { 
        return $this->getArrayVar($_GET, $key, $default);
    } 
}
?>