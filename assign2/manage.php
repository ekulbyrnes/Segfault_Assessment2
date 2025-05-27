<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "include/header.inc";?>
    <title>Manage Enquiries - SegFault Services</title>
</head>

<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>

    <?php
        // connect to sql database
        // if connection fails, draw error, else, continue with php
        require_once("settings.php");
        if(!$conn){
        echo "<p>Error: Database connection failure</p>";
        } else { // open brace around rest of php, remember to close brace at end of page's php
    ?>

    <section class="slideshow center-flex">
        <h1>Manage Enquiries</h1><br>
        <div>
            <p class="newline-flex"><span class="terminalblink">_</span>View and manage all applicants!</p>
        </div>
    </section>

    <section class="focus">
        <a id="belowheader"></a>
        <h1><span class="terminalblink">_</span>EOIs</h1>
        
        <!--draw results from other php pages-->
        <?php
            session_start();

            // if the edit message is set
            if(isset($_SESSION["EOI_edit_msg"])){
                // get session variable for edit message confirmation
                $EOI_edit_msg = $_SESSION["EOI_edit_msg"];
                // draw message
                echo "$EOI_edit_msg";

                // unset the error message variable so it does not render when the page is refreshed
                unset($_SESSION["EOI_edit_msg"]);
                // get the last rendered search table
                $EOI_search_table2 = $_SESSION["EOI_search_table2"];
                // get the statusid & EOI number of the EOI that was editted
                $statusid_edit = $_SESSION["statusid_edit"];
                $previous_status_id = $_SESSION["previous_status_id"];
                $EOI_edit = $_SESSION["EOI_edit"];
                // -- Edit the search table to reflect the edit changes
                // Loop for each statusid (1=New, 2=Current, 3=Final)
                for($i = 1; $i <= 3; $i++){
                    // searchstring finds the appropriate part of the string to edit
                    $searchstring = "<option class='jobRefNo_$EOI_edit' value='$i'";
                    // searchstring_selected is used to either find the currently selected status, or replace the updated status
                    $searchstring_selected = $searchstring." selected";
                    // if the loop is currently editting the statusid we want to update
                    if($i == $statusid_edit){
                        if($statusid_edit !== $previous_status_id){
                            // add selected to option
                            $EOI_search_table2 = str_replace("$searchstring", "$searchstring_selected", $EOI_search_table2);
                            echo "<p>add selected to $statusid_edit despite $previous_status_id</p>";
                        }
                    } else{
                        // remove selected from option
                        $EOI_search_table2 = str_replace("$searchstring_selected", "$searchstring", $EOI_search_table2);
                    }
                }
                // update session variable to the updated table
                $_SESSION["EOI_search_table2"] = $EOI_search_table2;

                // draw updated table
                echo "$EOI_search_table2";
            }
            // if the search table is set
            if(isset($_SESSION["EOI_search_table"])){
                // get the session variable
                $EOI_search_table = $_SESSION["EOI_search_table"];
                // draw search table results
                echo "$EOI_search_table";

                // unset session variable so it is not rendered when the page is refreshed
                unset($_SESSION["EOI_search_table"]);
                // back up the search table to a new session variable, used for redrawing the table when an EOI is modified
                $_SESSION["EOI_search_table2"] = $EOI_search_table;
            }
            // if the delete confirmation message is set
            if(isset($_SESSION["EOI_delete"])){
                // get the session variable
                $EOI_delete_msg = $_SESSION["EOI_delete"];
                // draw delete confirmation message
                echo "$EOI_delete_msg";

                // unset session variable so it is not rendered when the page is refreshed
                unset($_SESSION["EOI_delete"]);
            }

            session_write_close();
        ?>

        <!-- Search EOIs form-->
        <form method="post" action="searchEOI.php">
            <fieldset>
                <legend class="center-text"><h2>Search EOIs</h2></legend>

                <div class="form-container">
                    <label for="jobRefNo_filter" class="col-6" id="enhancement_3">Job Reference Number<br>
                        <?php
                            // create a dropdown list for all job reference numbers
                            $query = "SELECT jobRefNo FROM eoi;";

                            $result = mysqli_query($conn, $query);

                            if(!$result){
                                echo "<p>Error: Something is wrong with query: ", $query, "</p>";
                            } else {
                                echo "<select id='jobRefNo_filter' name='jobRefNo_filter'>\n
                                        <option value='' selected>Any</option>\n";
                                include "include/jobRefNo_options.inc";
                                echo "</select>";
                            }
                        ?>
                    </label>

                    <aside class="col-6"></aside>
 
                    <label for="firstName_filter" class="col-6">Name
                        <input type="text" name="firstName_filter" id="firstName_filter" maxlength="20" placeholder="First Name">
                    </label>
                    <label for="lastName_filter" class="col-6">
                        <input type="text" name="lastName_filter" id="lastName_filter" maxlength="20" placeholder="Last Name">
                    </label>

                    <label class="col-12" id="enhancement_4">Skills</label>
                    <label class="col-2" for="skill_java_filter">
                        <input type="checkbox" name="skill_java_filter" value="1" id="skill_java_filter">
                        Java
                    </label>
                    <label class="col-2" for="skill_cpp_filter">
                        <input type="checkbox" name="skill_cpp_filter" value="1" id="skill_cpp_filter">
                        C++
                    </label>
                    <label class="col-2" for="skill_php_filter">
                        <input type="checkbox" name="skill_php_filter" value="1" id="skill_php_filter">
                        PHP
                    </label>
                    <label class="col-2" for="skill_sql_filter">
                        <input type="checkbox" name="skill_sql_filter" value="1" id="skill_sql_filter">
                        MySQL
                    </label>
                    <label class="col-2" for="skill_python_filter">
                        <input type="checkbox" name="skill_python_filter" value="1" id="skill_python_filter">
                        Python
                    </label>
                    <label class="col-2" for="skill_other_filter">
                        <input type="checkbox" name="skill_other_filter" value="1" id="skill_other_filter">
                        Other
                    </label>
                    <input class="col-12" type="submit" value="Search">
                </div>
            </fieldset>
        </form>

        <form method="post" action="deleteEOI.php">
            <fieldset>
                <legend class="center-text"><h2>Delete EOIs</h2></legend>

                <div class="form-container">
                    <label for="jobRefNo_delete" class="col-6">Job Reference Number<br>
                        <?php
                            // create a dropdown list for all job reference numbers
                            $query = "SELECT jobRefNo FROM eoi;";

                            $result = mysqli_query($conn, $query);

                            if(!$result){
                                echo "<p>Error: Something is wrong with query: ", $query, "</p>";
                            } else {
                                echo "<select id='jobRefNo_delete' name='jobRefNo_delete' required>\n
                                        <option value='' selected>---</option>\n";
                                include "include/jobRefNo_options.inc";
                                echo "</select>";
                            }
                        ?>
                    </label>
                    <input type="submit" value="Delete">
                </div>
            </fieldset>
        </form>

    </section>

    <?php } // close brace around all php code ?>

    <!--Footer-->
    <?php include "include/footer.inc";?>
</body>

</html>