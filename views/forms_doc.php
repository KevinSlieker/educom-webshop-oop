<?php 
    require_once 'basic_doc.php';
   
    abstract class FormsDoc extends BasicDoc 
    { 

        protected function showFormStart() {
            echo '<form action="index.php" method="post">' . PHP_EOL;
        }

        protected function showFormSectionStart($key) {
            echo '<div class="' . $key . '">' . PHP_EOL;
        }

        protected function showFormItem($key, $type, $label, $placeholder = NULL, $options = array(), $rows = NULL, $cols = NULL) {
            echo '<label for="' . $key . '">' . $label . ' </label>' . PHP_EOL;
            $error = ($key . 'Err');
                if ($type == "select"){
                    echo '<' . $type . ' id="' . $key . '" name="' . $key . '">' . PHP_EOL;
                    //echo '<span class="error"> ' . $this->model->preambleErr . ' </span><br><br>' . PHP_EOL;
                    foreach($options as $english => $dutch){
                    echo '<option value="' . $english .'"'; if (isset($this->model->$key) && $this->model->$key == "$english") echo "selected"; echo'>' . $dutch . '</option>' . PHP_EOL;
                }   echo '</select>' . PHP_EOL;
                    echo '<span class="error"> ' . $this->model->$error . ' </span><br><br>' . PHP_EOL;            
                }   
                else if ($type == "radio") {
                    echo '<span class="error"> ' . $this->model->$error . ' </span><br>' . PHP_EOL;
                    foreach ($options as $english => $dutch) {
                    echo  '<input type="radio" id="' . $key . $english . '" name="' . $key . '"'; if (isset($this->model->$key) && $this->model->$key == "$english") echo "checked"; echo' value="' . $english . '" > 
                            <label for="' . $key . $english . '">' . $dutch . '</label><br>';
                } echo '<br>';
                } else if ($type == "textarea") {
                    echo '<textarea name ="' . $key . '" rows="' . $rows . '" cols="' . $cols . '" placeholder="' . $placeholder . '">' . $this->model->$key . '</textarea><br><br>';
                }
                else {
                    echo '<input type="' . $type . '"id="' . $key . '" name="' . $key . '" value="' . $this->model->$key . '" placeholder="' . $placeholder . '">' . PHP_EOL;
                    echo '<span class="error"> ' . $this->model->$error . ' </span><br><br>' . PHP_EOL;
                } 
        }

        protected function showFormSectionEnd() {
            echo '</div>' . PHP_EOL;
        }

        protected function showFormEnd($page, $name) {
            echo '<div>
                <input type="submit" value="' . $name . '">
                </div>
        
                <input type="hidden" name="page" value="' . $page . '">';
        
            echo '</form>' . PHP_EOL;
        }
        

    }
?>