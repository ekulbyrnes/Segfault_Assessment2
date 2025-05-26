<?php
require_once("settings.php");

require "include/sanitise_input_function.inc";

// redirect back to the manage page
function redirect(){
    header ("location: manage.php");
}

// get variables
$jobRefNo_filter       = sanitise_input("jobRefNo_filter");
$firstName_filter      = sanitise_input("firstName_filter");
$lastName_filter       = sanitise_input("lastName_filter");
$skill_java_filter     = sanitise_input("skill_java");
$skill_cpp_filter      = sanitise_input("skill_cpp");
$skill_php_filter      = sanitise_input("skill_php");
$skill_sql_filter      = sanitise_input("skill_sql");
$skill_python_filter   = sanitise_input("skill_python");
// open form/table
$EOI_search_table =
"<fieldset>\n
    <legend class='center-text'><h2>Search Results</h2></legend>\n
    <table class='EOItable'>\n";

// error and redirect if connection fails
if(!$conn){
        echo "<p>Error: Database connection failure</p>";

        redirect();
}

$sql_table = "eoi";

$query = "  SELECT * FROM $sql_table WHERE
            jobRefNo LIKE '$jobRefNo_filter%'
            AND firstName LIKE '$firstName_filter%'
            AND lastName LIKE '$lastName_filter%'";
if($skill_java_filter) {
    $query .= " AND skill_java LIKE 1";
}
if($skill_cpp_filter) {
    $query .=  " AND skill_cpp LIKE 1";
}
if($skill_php_filter) {
    $query .=  " AND skill_php LIKE 1";
}
if($skill_sql_filter) {
    $query .=  " AND skill_sql LIKE 1";
}
if($skill_python_filter) {
    $query .=  " AND skill_python LIKE 1";
}

$query .= ";";

$result = mysqli_query($conn, $query);

// if result is invalid: error
if(!$result){
    $EOI_search_table .= "<p>Error: Something is wrong with query: ". $query. "</p>";
}else if(mysqli_num_rows($result) == 0){
    // if the search was successful but there are no results
    $EOI_search_table .= "<p>No results found.</p>";
}else{ // draw table of results
    // table header
    $EOI_search_table .= 
        "<tr>\n
            <th scope='col' id='EOInum'>EOI Num.</th>\n
            <th scope='col'>Job Ref.</th>\n
            <th scope='col'>Status</th>\n
            <th scope='col'>First Name</th>\n
            <th scope='col'>Last Name</th>\n
            <th scope='col' id='email'>Email</th>\n
            <th scope='col' id='skills'>Skills</th>\n
        </tr>\n";
    // loop for each EOI result
    while($row = mysqli_fetch_assoc($result)){
        // table results
        $rowstatus = $row["status"];
        
        $EOI_search_table .=
        "<tr>\n
        <form method='post' action='editEOI.php?edit=". $row["EOInumber"]. "'>\n
            <td>". $row["EOInumber"]. "</td>\n
        
            <td>". $row["jobRefNo"]. "</td>\n

            <td>\n
                <select name='status' id='status'>\n
                    <option value='1'";
                        if($rowstatus == '1'){
                        $EOI_search_table .= " selected";
                    }
                    $EOI_search_table .= ">New</option>\n
                    <option value='2'";
                        if($rowstatus == '2'){
                        $EOI_search_table .= " selected";
                    }
                    $EOI_search_table .= ">Current</option>\n
                    <option value='3'";
                    if($rowstatus == '3'){
                        $EOI_search_table .= " selected";
                    }
                    $EOI_search_table .= ">Final</option>\n
                </select><br>\n
                <input type='submit' value='Apply Changes' class='centerimage'>\n
            </td>\n

            <td>". $row["firstName"]. "</td>\n

            <td>". $row["lastName"]. "</td>\n

            <td>". $row["email"]. "</td>\n

            <td>\n
                <ul>\n";
            if($row["skill_java"]){
                $EOI_search_table .= "<li>Java</li>\n";
            }
            if($row["skill_php"]){
                $EOI_search_table .= "<li>PHP</li>\n";
            }
            if($row["skill_cpp"]){
                $EOI_search_table .= "<li>C++</li>\n";
            }
            if($row["skill_sql"]){
                $EOI_search_table .= "<li>MySQL</li>\n";
            }
            if($row["skill_python"]){
                $EOI_search_table .= "<li>Python</li>\n";
            }
            $EOI_search_table .= "</ul>\n";

            if($row["skill_other"]){
                $EOI_search_table .= "Other Skills Here\n";
            }
            
            $EOI_search_table .= "</td>\n
        </form>
        </tr>\n";
    }

}
// close form/table
$EOI_search_table .=
    "</table>\n
</fieldset>\n";

mysqli_free_result($result);

// send table result back to the manage page
// open session
session_id('search');
session_start();
// create variable to transfer to manage page
$_SESSION["EOI_search_table"] = $EOI_search_table;

mysqli_close($conn);

// redirect back to manage page  
redirect();

    
?>