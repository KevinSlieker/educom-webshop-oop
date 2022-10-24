<?php

session_start();

require_once('session_manager.php');
require_once('validations.php');
require_once("user_service.php");
require_once("db_repository.php");
require_once("forms.php");
require_once("products_service.php");

$page = getRequestedPage();
$data = processRequest($page);
showResponsePage($data);

//var_dump($data);
var_dump($_SESSION);

function processRequest($page)  {

    switch($page) {
        case 'login':
            $data = validateLogin();
            if ($data['valid']) {
               doLoginUser($data['name'], $data['user_id']);
               $page = 'home';
            } 
            break;
        case 'logout':
            doLogoutUser(); 
            $page = 'home'; 
            break;
        case 'contact':
            $data = validateContact();
            if ($data['valid']) {
               $page = 'thanks';
           }
           break;
        case 'register':
            $data = validateRegister();
            if ($data['valid']) {
                try {
                storeUser($data["email"],$data["name"],$data["password"]);
                $page = 'login' ;
                } catch (Exception $e) {
                    $data['genericErr'] = "Er is een technisch probleem opgetreden.";
                    logToServer("storeUser failed: ".$e->getMessage());
                }
            }
            break;
        case "webshop":
            $data = handleActions();
            $data = array_merge($data, getWebshopProducts());
            break;
        case "detail":
            $data = handleActions();
            $id = getUrlVar("id");
            $data = array_merge($data, getProductDetails($id));
            break;
        case "shoppingcart":
            $data = handleActions();
            $data = array_merge($data, getShoppingcartProducts());
            break;
        case "home":
            $data = handleActions();
            break;
     }
      $data['page'] = $page;
      return $data;
 
}
 
function showContent($data) 
{ 
    if (isset($data['genericErr'])) {
        echo '<span class="error"> ' . $data['genericErr'] . ' </span><br>' . PHP_EOL;
    }
   switch($data['page']) 
   { 
       case 'home':
            require_once('home.php');
            showHomeContent($data);
            break;
       case 'about':
            require_once('about.php');
            showAboutContent($data);
            break;
       case 'contact':
            require_once('contact.php');
            showContactForm($data);
            break;
       case 'thanks':
            require_once('contact.php');
            showContactThanks($data);
            break;     
       case 'register':
            require_once('register.php');
            showRegisterForm($data);
            break;
       case 'login':
            require_once('login.php');
            showLoginForm($data);
            break;
       case "webshop":
            require_once('webshop.php');
            showWebshopContent($data);
            break;
        case "detail":
            require_once('detail.php');
            showDetailContent($data);
            break;
        case "shoppingcart":
            require_once('shoppingcart.php');
            showShoppingcartContent($data);
            break;   
       default:
            echo 'Error : Page NOT Found';  
   }     
}  


function getRequestedPage() 
{     
   $requested_type = $_SERVER['REQUEST_METHOD']; 
   if ($requested_type == 'POST') 
   { 
       $requested_page = getPostVar('page','home'); 
   } 
   else 
   { 
       $requested_page = getUrlVar('page','home'); 
   } 
   return $requested_page; 
} 

function showResponsePage($data) 
{ 
   beginDocument(); 
   showHeadSection($data); 
   showBodySection($data); 
   endDocument(); 
}

function getArrayVar($array, $key, $default='') 
{  
   return isset($array[$key]) ? $array[$key] : $default; 
} 

function getPostVar($key, $default='') 
{ 
    return getArrayVar($_POST, $key, $default);

}

function getUrlVar($key, $default='') 
{ 
   return getArrayVar($_GET, $key, $default);
} 

function beginDocument() 
{ 
   echo '<!doctype html> 
<html>'; 
} 

function showHeadSection($data) 
{ 
  echo '<head><title>';  
  switch ($data['page']) {
    case 'home' :
        require_once('home.php');
        showHomeHead();
        break;
    case 'about' :
        require_once('about.php');
        showAboutHead();
        break;
    case 'contact' :
        require_once('contact.php');
        showContactHead();
        break;
    case 'thanks':
        require_once('contact.php');
        ShowContactHead();
        break;    
    case 'register':
        require_once('register.php');
        showRegisterHead();
        break;
    case 'login':
        require_once('login.php');
        showLoginHead();
        break;
    case "webshop":
        require_once('webshop.php');
        showWebshopHead($data);
        break;
    case "detail":
        require_once('detail.php');
        showDetailHead($data);
        break;
    case "shoppingcart":
        require_once('shoppingcart.php');
        showShoppingcartHead($data);
        break; 
    default:
        echo 'Error : Page NOT Found';

  }
  echo '</title> <link rel="stylesheet" href="CSS/stylesheet.css"> </head>';
} 

function showBodySection($data) 
{ 
   echo '    <body>' . PHP_EOL; 
   showHeader($data);
   showMenu(); 
   showContent($data); 
   showFooter(); 
   echo '    </body>' . PHP_EOL; 
} 

 
function showHeader($data) 
{ 
    echo '<h1>';
    switch ($data['page']) {
        case 'home' :
            require_once('home.php');
            showHomeHeader();
            break;
        case 'about' :
            require_once('about.php');
            showAboutHeader();
            break;
        case 'contact' :
            require_once('contact.php');
            showContactHeader();
            break;
        case 'thanks':
            require_once('contact.php');
            ShowContactHeader();
            break;    
        case 'register':
            require_once('register.php');
            showRegisterHeader();
            break;
        case 'login':
            require_once('login.php');
            showLoginHeader();
            break;
        case "webshop":
            require_once('webshop.php');
            showWebshopHeader($data);
            break;
        case "detail":
            require_once('detail.php');
            showDetailHeader($data);
            break;
        case "shoppingcart":
            require_once('shoppingcart.php');
            showShoppingcartHeader($data);
            break; 
        default:
            echo 'Error : Page NOT Found';
    }
    echo '</h1>';

} 

function showMenu() 
{ 
    echo '<div class="links">
    <ul>
      <li><a Href="index.php?page=home">Home</a></li>
      <li><a Href="index.php?page=about">About</a></li>
      <li><a Href="index.php?page=contact">Contact</a></li>
      <li><a Href="index.php?page=webshop">Webshop</a></li>';

    if (isUserLoggedIn()) {
        echo showMenuItem("shoppingcart", "Shoppingcart");
        echo showMenuItem("logout", "Logout " . getLoggedInUsername());
    } else {
        echo showMenuItem ("login", "Login");
        echo showMenuItem ("register", "Registrer");
    }

    echo '</ul>
	</div>';
} 

function showMenuItem($page, $label) {
    return PHP_EOL.'<li><a Href="index.php?page='. $page .'">'.$label.'</a></li>';
}


 
function showFooter() 
{ 
  echo '  <footer>
  <h2> &copy;, 2022, Kevin Slieker </h2>
</footer>';
} 


function endDocument() 
{ 
   echo  '</html>'; 
} 

function logToServer($message) {
    echo "logToServer: $message";
}
?>