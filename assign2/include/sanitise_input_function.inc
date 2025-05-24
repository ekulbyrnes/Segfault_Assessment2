<?php
    // function to sanitise data
    function sanitise_input($input){
        if(isset($_POST[$input])){
            $input = $_POST[$input];
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    }
?>