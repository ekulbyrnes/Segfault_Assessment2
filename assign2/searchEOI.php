<?php
/* 
    conn mysql

    get inputs & clean
        jobrefno
        firstname
        lastname
    
    set query = select * from EOIs WHERE refno LIKE jobrefno% AND...

    result = query(conn, query)

    if theres no result
        error
    else
        draw table of results
        form
            <td>, $row["column"], </td>\n
            <td>, input type select - change status
        
            input submit changes

        mysqli free result

    mysqli close

*/

require_once("settings.php");

require "include/sanitise_input_function.inc";

// redirect back to the manage page
function redirect(){
    header ("location: manage.php");
}

// open session
session_start();

// get variables
$jobRefNo_filter       = sanitise_input("jobRefNo_filter");
$firstName_filter      = sanitise_input("firstName_filter");
$lastName_filter       = sanitise_input("lastName_filter");

if(!$conn){
        echo "<p>Error: Database connection failure</p>";
    } else{
        $sql_table = "eoi";

        $query = "  SELECT * FROM $sql_table WHERE
                    jobRefNo LIKE '$jobRefNo_filter%'
                    AND firstName LIKE '$firstName_filter%'
                    AND lastName LIKE '$lastName_filter%';";
        
        $result = mysqli_query($conn, $query);

        // open form/table
        $EOI_search_table =
        "<form method='post' action='editEOI.php'>\n
            <fieldset>
                <legend class='center-text'><h2>Search Results</h2></legend>\n
                <table class='EOItable'>\n";

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
                        <th scope='col'>Job Ref.</th>\n
                        <th scope='col'>Status</th>\n
                        <th scope='col'>First Name</th>\n
                        <th scope='col'>Last Name</th>\n
                        <th scope='col'>Email</th>\n
                    </tr>\n";
            // loop for each EOI result
            while($row = mysqli_fetch_assoc($result)){
                // table results
                $EOI_search_table .=
                            "<tr>\n
                                <td>". $row["jobRefNo"]. "</td>\n
                                <td>\n
                                    <select name='status' id='status'>\n
                                        <option value='New'>New</option>\n
                                        <option value='Current'>Current</option>\n
                                        <option value='Final'>Final</option>\n
                                </td>\n
                                <td>". $row["firstName"]. "</td>\n
                                <td>". $row["lastName"]. "</td>\n
                                <td>". $row["email"]. "</td>\n
                            </tr>\n";
            }
        }
        // close form/table
        $EOI_search_table .=
                "</table>\n
            <br>\n
            <input type='submit' value='Apply Changes' class='centerimage'>\n
            </fieldset>\n
        </form>\n";
    }
    mysqli_free_result($result);
            
    // send table result back to the manage page
    $_SESSION["EOI_search_table"] = $EOI_search_table;
    redirect();

    mysqli_close($conn);
?>