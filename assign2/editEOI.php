<?php

require_once("settings.php");

// redirect back to the manage page
function redirect(){
    header ("location: manage.php#belowheader");
    exit();
}

// get variables
$EOInumber = $_GET['edit'];
$statusid = $_POST['status'];
$previous_status_id = $_POST['previous_status_id'];
// create array of statuses
$statuses = array("New", "Current", "Final");
// select the appropriate status
$status = $statuses[$statusid -1];

// open fieldset
$EOI_edit_msg = "<fieldset>\n
        <legend class='center-text'><h2>Edit Confirmation</h2></legend>\n";

// error and redirect if connection fails
if(!$conn){
    $EOI_delete_msg .= "<p>Error: Database connection failure</p>";
    $EOI_delete_msg .= "</fieldset>\n";
    redirect();
}

$query = 
    "UPDATE eoi
    SET status = $statusid
    WHERE EOInumber = $EOInumber;";

$result = mysqli_query($conn, $query);

    if(!$result){
        $EOI_edit_msg .= "<p>Error: EOI $EOInumber was not succesfully updated to $status.</p>\n";
        //echo "Error: Something wrong with: $query\n";
    } else{
        $EOI_edit_msg .= "<p>EOI $EOInumber was successfully updated to $status.</p>\n";
        //echo "Successfully performed: $query\n";
    }

// close fieldset
$EOI_edit_msg .= "</fieldset>\n";

    // send table result back to the manage page
    // open session
    session_start();
    // create variable to transfer to manage page
    $_SESSION["EOI_edit"] = $EOInumber;
    $_SESSION["statusid_edit"] = $statusid;
    $_SESSION["previous_status_id"] = $previous_status_id;
    $_SESSION["EOI_edit_msg"] = $EOI_edit_msg;
    
    mysqli_close($conn);

    // redirect back to manage page
    redirect();
   
?>