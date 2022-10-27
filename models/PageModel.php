<?php

class PageModel {
    public $page;
    protected $isPost = false;
    public $menu;
    public $errors = array();
    public $genericErr = NULL;
    protected $sessionManager;
 
    // ...
 
 
 
    public function __construct($copy) {
       if (empty($copy)) {
           // ==> First instance of PageModel
           $this->sessionManager = new SessionManager();
        } else {
           // ==> Called from the constructor of an extended class.... 
           $this->page = $copy->page;
           $this->isPost = $copy->isPost;
           $this->menu = $copy->menu;
           $this->genericErr = $copy->genericErr;
           $this->sessionManager = $copy->sessionManager; 
        }
    }
 
 
    public function getRequestedPage() {
       $this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');
       if ($this->isPost) {
            $this->setPage($this->getPostVar("page", "home"));
       } else {
            $this->setPage($this->getUrlVar("page", "home"));
       }
    }
 
   
 
    protected function setPage($newPage) {
        $this->page = $newPage;
    } 
 

    protected function getArrayVar($array, $key, $default='') 
    {  
        return isset($array[$key]) ? $array[$key] : $default; 
    } 

    protected function getPostVar($key, $default='') 
    { 
        return getArrayVar($_POST, $key, $default);
    }

    protected function getUrlVar($key, $default='') 
    { 
        return getArrayVar($_GET, $key, $default);
    } 
 
 
    public function createMenu() {
        $this->menu['home'] = new MenuItem('home', 'Home');
        $this->menu['about'] = new MenuItem('about', 'About');
        $this->menu['contact'] = new MenuItem('contact', 'Contact');
        $this->menu['webshop'] = new MenuItem('webshop', 'Webshop');
        if ($this->sessionManger->isUserLoggedIn()) {
            $this->menu['shoppingcart'] = new MenuItem('shoppingcart', 'Shoppingcart');
            $this->menu['logout'] = new MenuItem('logout', 'LOGOUT', 
                                $this->sessionManager->getLoggedInUser()['name']);
        } else {
            $this->menu['login'] = new MenuItem('login', 'Login');
            $this->menu['register'] = new MenuItem('register', 'Register');
        }
     }
}
?>