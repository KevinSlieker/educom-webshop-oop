<?php
/*
showFormStart();
showFormSectionStart("preamble");
showFormItem("preamble", "select", "Aanhef:", $data, NULL, array('mr'  => "Meneer", 'mrs' => "Mevrouw"));
showFormSectionEnd();

<div class="preamble">
<label for="preamble">Aanhef: </label>
<select id="preamble" name="preamble">
    <option value="mr"';  if (isset($data['preamble']) && $data['preamble'] == "mr") echo "selected"; echo'>Meneer</option>
    <option value="mrs"';  if (isset($data['preamble']) && $data['preamble'] == "mrs") echo "selected"; echo'>Mevrouw</option>
</select> <br>
</div>



showFormSectionStart("info");
showFormItem("name", "text", "Naam:", $data,  "John");

...
showFormEnd("contact", "Submit");


<div class="info">
		<br>
		<label for="name">Naam:</label>
		<input type="text" id="name" name="name" value="' . $data['name']. '" placeholder="John">
		<span class="error"> ' . $data['nameErr'] . ' </span><br><br>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="' . $data['email'] . '" placeholder="Doe@gmail.com">
		<span class="error"> ' . $data['emailErr'] . ' </span><br><br>
		<label for="phonenumber">Telefoonnummer:</label>
		<input type="tel" id="phonenumber" name="phonenumber" value="' . $data['phonenumber'] . '" placeholder="0612345678">
		<span class="error">' . $data['phonenumberErr'] . '</span><br><br>
	</div>

    	<div class="communication">
		<br>
		<label for="communication">Voorkeur communicatie:</label>
		<span class="error"> ' . $data['communicationErr'] . '</span><br>
		<input type="radio" id="email2" name="communication"';  if (isset($data['communication']) && $data['communication'] == "email") echo "checked"; echo' value="email" >
		<label for="email2">Email</label><br>
		<input type="radio" id="phone" name="communication"'; if (isset($data['communication']) && $data['communication'] == "phone") echo "checked"; echo' value="phone">
		<label for="phone">Telefoon</label><br>
		<br>
	</div>

    array('mr'  => "Meneer", 'mrs' => "Mevrouw"))
showFormItem("communication", "radio", "Voorkeur communicatie:", $data, NULL, array('email'  => "Email", 'phone' => "Telefoon"), array('email2', 'phone'));    

	<div class="input">
		<label for="input">Text veld: </label>
		<textarea name="input" rows="8" cols="30" placeholder="Vul hier overige informatie die van belang is in.">' . $data['input'] . '</textarea> <br>
		<br>
	</div>
*/

function showFormStart() {
    echo '<form action="index.php" method="post">' . PHP_EOL;
}

function showFormSectionStart($key) {
    echo '<div class="' . $key . '">' . PHP_EOL;
}

function showFormItem($key, $type, $label, $data, $placeholder = NULL, $options = array(), $rows = NULL, $cols = NULL) {
    echo '<label for="' . $key . '">' . $label . ' </label>' . PHP_EOL;
        if ($type == "select"){
            echo '<' . $type . ' id="' . $key . '" name="' . $key . '">' . PHP_EOL;
            echo '<span class="error"> ' . $data['' . $key . 'Err'] . ' </span><br><br>' . PHP_EOL;
            foreach($options as $english => $dutch){
            echo '<option value="' . $english .'"'; if (isset($data[$key]) && $data[$key] == "$english") echo "selected"; echo'>' . $dutch . '</option>' . PHP_EOL;
        }   echo '</select>' . PHP_EOL;
            echo '<span class="error"> ' . $data['' . $key . 'Err'] . ' </span><br><br>' . PHP_EOL;            
        }   
        else if ($type == "radio") {
            echo '<span class="error"> ' . $data['' . $key . 'Err'] . ' </span><br>' . PHP_EOL;
            foreach ($options as $english => $dutch) {
            echo  '<input type="radio" id="' . $key . $english . '" name="' . $key . '"'; if (isset($data[$key]) && $data[$key] == "$english") echo "checked"; echo' value="' . $english . '" > 
                    <label for="' . $key . $english . '">' . $dutch . '</label><br>';
        } echo '<br>';
        } else if ($type == "textarea") {
            echo '<textarea name ="' . $key . '" rows="' . $rows . '" cols="' . $cols . '" placeholder="' . $placeholder . '">' . $data[$key] . '</textarea><br><br>';
        }
        else {
            echo '<input type="' . $type . '"id="' . $key . '" name="' . $key . '" value="' . $data[$key] . '" placeholder="' . $placeholder . '">' . PHP_EOL;
            echo '<span class="error"> ' . $data['' . $key . 'Err'] . ' </span><br><br>' . PHP_EOL;
        } 
}


function showFormSectionEnd() {
    echo '</div>' . PHP_EOL;
}

function showFormEnd($page, $name) {
    echo '<div>
        <input type="submit" value="' . $name . '">
        </div>

        <input type="hidden" name="page" value="' . $page . '">';

    echo '</form>' . PHP_EOL;
}


?>