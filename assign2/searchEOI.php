<?php
require_once("settings.php");

require "include/sanitise_input_function.inc";

// function to redirect back to the manage page
function redirect(){
    header ("location: manage.php#belowheader");
    exit();
}

// Restrict direct access to searchEOI.php file from browser
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: manage.php');
    exit();
}

// get variables
$jobRefNo_filter       = sanitise_input("jobRefNo_filter");
$firstName_filter      = sanitise_input("firstName_filter");
$lastName_filter       = sanitise_input("lastName_filter");
$skill_java_filter     = sanitise_input("skill_java_filter");
$skill_cpp_filter      = sanitise_input("skill_cpp_filter");
$skill_php_filter      = sanitise_input("skill_php_filter");
$skill_sql_filter      = sanitise_input("skill_sql_filter");
$skill_python_filter   = sanitise_input("skill_python_filter");
$skill_other_filter    = sanitise_input("skill_other_filter");

// open form/table
$EOI_search_table =
"<fieldset>\n
    <legend class='center-text'><h2>Search Results</h2></legend>\n";

// error and redirect if connection fails
if(!$conn){
        echo "<p>Error: Database connection failure</p>
              </fieldset>";
        redirect(); 
}

// sql query returns results that are filtered by user input
// % matches any number of any characters, meaning if the inputs are left black, it will match all
$query = "  SELECT * FROM eoi WHERE
            jobRefNo LIKE '$jobRefNo_filter%'
            AND firstName LIKE '$firstName_filter%'
            AND lastName LIKE '$lastName_filter%'
            AND skill_java LIKE '$skill_java_filter%'
            AND skill_cpp LIKE '$skill_cpp_filter%'
            AND skill_php LIKE '$skill_php_filter%'
            AND skill_sql LIKE '$skill_sql_filter%'
            AND skill_python LIKE '$skill_python_filter%'
            AND skill_other LIKE '$skill_other_filter%'
            ;";

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
    "<table class='EOItable'>\n
        <tr>\n
            <th scope='col' id='EOInum'>EOI Num.</th>\n
            <th scope='col'>Job Ref.</th>\n
            <th scope='col'>Status</th>\n
            <th scope='col'>First Name</th>\n
            <th scope='col'>Last Name</th>\n
            <th scope='col' id='tableemail'>Email</th>\n
            <th scope='col' id='skills'>Skills</th>\n
        </tr>\n";
    // loop for each EOI result
    while($row = mysqli_fetch_assoc($result)){
        // -- table results       
        $EOI_search_table .=
        "<tr>\n
            
            <td class='center-text'>". $row["EOInumber"]. "</td>\n
        
            <td>". $row["jobRefNo"]. "</td>\n

            <td>\n
                <form method='post' action='editEOI.php?edit=". $row["EOInumber"]. "'>\n
                    <label for='status". $row["EOInumber"]. "'>\n
                        <select name='status' id='status". $row["EOInumber"]. "'>\n
                            <option class='jobRefNo_". $row["EOInumber"]. "' value='1'";
                                // if the status of the current EOI is 1, add 'selected' to the current option
                                if($row["status"] == '1'){
                                    $EOI_search_table .= " selected";
                            }
                            $EOI_search_table .= ">New</option>\n
                            <option class='jobRefNo_". $row["EOInumber"]. "' value='2'";
                                // if the status of the current EOI is 2, add 'selected' to the current option
                                if($row["status"] == '2'){
                                    $EOI_search_table .= " selected";
                            }
                            $EOI_search_table .= ">Current</option>\n
                            <option class='jobRefNo_". $row["EOInumber"]. "' value='3'";
                                // if the status of the current EOI is 3, add 'selected' to the current option
                                if($row["status"] == '3'){
                                    $EOI_search_table .= " selected";
                            }
                            $EOI_search_table .= ">Final</option>\n
                        </select>\n
                        <input type='hidden' name='previous_status_id' value='". $row["status"]. "'>\n
                    </label>\n
                    <input type='submit' value='Apply Changes'>\n
                </form>\n
            </td>\n

            <td>". $row["firstName"]. "</td>\n

            <td>". $row["lastName"]. "</td>\n

            <td>". $row["email"]. "</td>\n

            <td>\n
                <ul>\n";
            // if the current EOI has skill_java, add java to their list of skills
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
                $EOI_search_table .= $row["skill_other_details"]. "\n";
            }
            
            $EOI_search_table .= "</td>\n
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
session_start();
// create variable to transfer to manage page
$_SESSION["EOI_search_table"] = $EOI_search_table;

mysqli_close($conn);

// redirect back to manage page  
redirect();
?>