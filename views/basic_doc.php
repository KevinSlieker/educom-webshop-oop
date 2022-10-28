<?php 
    require_once 'html_doc.php';
   
    class BasicDoc extends HtmlDoc 
    { 
        protected $model;

        public function __construct($model) {
            $this->model = $model;
        }       

        private function title() {
            echo "<title>"; 
            $this->showHead();
            echo "</title>";
        } 

        protected function showHead() {
            echo 'Basic';
        }
        
        private   function cssLinks() {
            echo '<link rel="stylesheet" href="CSS/stylesheet.css">';
        }

        private   function bodyHeader() {
            echo '<h1>';
            $this->showHeader();
            echo '</h1>';
        }

        protected function showHeader() {
            echo 'Basic';
        }

        private   function mainMenu() {
            echo '<div class="links">
            <ul>';
            foreach($this->model->menu as $MenuItem) {
                echo $MenuItem->showMenuItem();
            }
            echo '</ul>
            </div>';

            
        }
        /*
        private function showMenuItem($page, $label) {
                return PHP_EOL.'<li><a Href="index.php?page='. $page .'">'.$label.'</a></li>';
            }
*/
        protected function mainContent() {
            echo '<p> Content </p>';
        }

        protected function showGenericErr(){
            if (isset($this->model->genericErr)) {
                echo '<span class="error">' . $this->model->genericErr . '</span><br>' . PHP_EOL;
            }
        }
        

        private   function bodyFooter() {
            echo '  <footer>
            <h2> &copy;, 2022, Kevin Slieker </h2>
            </footer>';
        }

        // Override function from htmlDoc
        protected function headContent()         {
            $this->title();
            $this->cssLinks();
        } 

        // Override function from htmlDoc
        protected function bodyContent()         {
            $this->bodyHeader();
            $this->mainMenu();
            $this->showGenericErr();
            $this->mainContent();
            $this->bodyFooter();
        }   
    }
?>