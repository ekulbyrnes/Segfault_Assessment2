<?php
require_once("settings.php");

require "include/sanitise_input_function.inc";

// get variables
$jobRefNo_filter = sanitise_input("jobRefNo_filter");

if(!$conn){
        echo "<p>Error: Database connection failure</p>";
    } else{

        $sql_table = "eoi";

        $query = "DELETE FROM $sql_table WHERE jobRefNo = '$jobRefNo_filter';";
        
        $result = mysqli_query($conn, $query);
        
        if(!$result){
            echo "<p>Error: Something is wrong with query: ", $query, "</p>";
        }else{
            echo "<p>successfully executed ", $query, "</p>";
        }
    }

?>