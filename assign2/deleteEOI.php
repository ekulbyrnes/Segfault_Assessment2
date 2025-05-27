<?php
require_once("settings.php");

require "include/sanitise_input_function.inc";

// redirect back to the manage page
function redirect(){
    header ("location: manage.php#belowheader");
}

// get variables
$jobRefNo_filter = sanitise_input("jobRefNo_filter");

// open fieldset
$EOI_delete_msg = "<fieldset>\n
        <legend class='center-text'><h2>Deletion Confirmation</h2></legend>\n";

// error and redirect if connection fails
if(!$conn){
        $EOI_delete_msg .= "<p>Error: Database connection failure</p>";
        $EOI_delete_msg .= "</fieldset>\n";
        redirect();
}

$sql_table = "eoi";

$query = "DELETE FROM $sql_table 
            WHERE jobRefNo = '$jobRefNo_filter';";

$result = mysqli_query($conn, $query);

if(!$result){
    $EOI_delete_msg .= "<p>Error: EOIs with reference number $jobRefNo were not succesfully deleted.</p>\n";
    //echo "Error: Something wrong with: $query\n";
} else{
    $EOI_delete_msg .= "<p>EOIs with reference number $jobRefNo_filter were successfully deleted.</p>\n";
    //echo "Successfully performed: $query\n";
}

// close fieldset
$EOI_delete_msg .= "</fieldset>\n";

    // send table result back to the manage page
    // open session
    session_start();
    // create variable to transfer to manage page
    $_SESSION["EOI_delete"] = $EOI_delete_msg;
    
    mysqli_close($conn);

    // redirect back to manage page
    redirect();
?>