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

// function to sanitise data
function sanitise_input($input){
    $input = $_POST[$input];
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

// get variables
$jobRefNo_filter       = sanitise_input("jobRefNo_filter");
$firstName_filter      = sanitise_input("firstName_filter");
$lastName_filter       = sanitise_input("lastName_filter");
/*
    $DOB            = sanitise_input("DOB");
    $gender         = sanitise_input("gender");
    $othergender    = sanitise_input("othergender");
    $address        = sanitise_input("address");
    $suburb         = sanitise_input("suburb");
    $postcode       = sanitise_input("postcode");
    $state          = sanitise_input("state");
    $phonenumber    = sanitise_input("phonenumber");
    $email          = sanitise_input("email");
    $skill_java     = sanitise_input("skill_java");
    $skill_cpp      = sanitise_input("skill_cpp");
    $skill_php      = sanitise_input("skill_php");
    $skill_sql      = sanitise_input("skill_sql");
    $skill_python   = sanitise_input("skill_python");
    $skill_other    = sanitise_input("skill_other");
    $skill_other_details    = sanitise_input("skill_other_details");
*/

if(!$conn){
        echo "<p>Error: Database connection failure</p>";
    } else{
        $sql_table = "EOIs";

        $query = "  SELECT * FROM eoi WHERE
                    jobRefNo LIKE '$jobRefNo_filter%'
                    AND firstName LIKE '$firstName_filter%'
                    AND lastName LIKE '$lastName_filter%';";
        
        $result = mysqli_query($conn, $query);

        // if result is invalid: error
        if(!$result){
            echo "<p>Error: Something is wrong with query: ", $query, "</p>";
        }else{ // draw table of results
                echo
                "<form method='post' action='editEOI.php'>
                <table>\n
                    <tr>\n
                        <th scope=\"col\">Job Reference Number</th>\n
                        <th scope=\"col\">First Name</th>\n
                        <th scope=\"col\">Last Name</th>\n
                        <th scope=\"col\">Status</th>\n
                    </tr>\n";
                // loop for each EOI result
                while($row = mysqli_fetch_assoc($result)){
                    echo
                    "<tr>\n
                        <td>", $row["jobRefNo"], "</td>\n
                        <td>", $row["firstName"], "</td>\n
                        <td>", $row["lastName"], "</td>\n";
                        // create a dropdown list for all status options
                        echo
                        "<td>\n
                            <select name='status' id='status'>\n
                                <option value='New'>New</option>\n
                                <option value='Current'>Current</option>\n
                                <option value='Final'>Final</option>\n
                        </td>\n
                    </tr>\n";
                }
                echo
                "</table>\n
                <input type='submit' value='Apply Changes'>\n
                </form>\n";

                mysqli_free_result($result);
            }

    mysqli_close($conn);
    }
?>