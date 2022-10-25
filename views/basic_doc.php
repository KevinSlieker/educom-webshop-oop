<?php 
    require_once 'html_doc.php';
   
    class BasicDoc extends HtmlDoc 
    { 
        protected $data;

        public function __construct($myData) {
            $this->data = $myData;
        }       

        protected function title()         {
            echo "<title>" . $this->data['page'] . "</title>";
        } 
        
        private   function cssLinks() {
            echo '<link rel="stylesheet" href="CSS/stylesheet.css">';
        }

        private   function bodyHeader() {
            echo '<h1>' . $this->data['page'] . '</h1>';
        }

        private   function mainMenu() {
            echo '<div class="links">
            <ul>';
            foreach($this->data['menu'] as $page => $label) {
                echo $this->showMenuItem($page, $label);
            }
            echo '</ul>
            </div>';

            
        }
        
        private function showMenuItem($page, $label) {
                return PHP_EOL.'<li><a Href="index.php?page='. $page .'">'.$label.'</a></li>';
            }

        protected function mainContent() {
            echo '<p> Content </p>';
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
            $this->mainContent();
            $this->bodyFooter();
        }   
    }
?>