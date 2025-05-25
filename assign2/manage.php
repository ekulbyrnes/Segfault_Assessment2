<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="SegFault Services">
    <meta name="charset" content="utf-8">
    <meta name="keywords" content="computing, recruiting, services">
    <!-- Adding in the global styles -->
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="manifest" href="site.webmanifest">

    <title>Manage Enquiries - SegFault Services</title>
</head>

<body>
    <?php
        // connect to sql database
        // if connection fails, draw error, else, continue with php
        require_once("settings.php");
        if(!$conn){
        echo "<p>Error: Database connection failure</p>";
        } else { // open brace around rest of php, remember to close brace at end of page's php

        // draw nav bar
        include "include/navbar.inc";
    ?>

    <section class="slideshow center-flex">
        <h1>Manage Enquiries</h1><br>
        <div>
            <p class="newline-flex"><span class="terminalblink">_</span>View and manage all applicants!</p>
        </div>
    </section>

    <section class="focus">
        <h1><span class="terminalblink">_</span>EOIs</h1>

        <!--EOI TABLE
            Buttons to:
                - list all EOIs
                - List all EOIs for a position (job reference number, dropdown?)
                - List all EOIs for an applicant (name inputs)
                    - Change the status of an EOI (dropdown)
                - Delete all EOIs for a position (job reference number, dropdown?)
        -->

        <!--draw search results-->
        <?php
            session_start();
            if(isset($_SESSION["EOI_edit"])){
                $EOI_edit_msg = $_SESSION["EOI_edit"];
                echo "$EOI_edit_msg";
            } else if(isset($_SESSION["EOI_search_table"])){
                $EOI_search_table = $_SESSION["EOI_search_table"];
                echo "$EOI_search_table";
            } else if(isset($_SESSION["EOI_delete"])){
            $EOI_delete_msg = $_SESSION["EOI_delete"];
            echo "$EOI_delete_msg";
            }
            
            // clear variables so the table isn't always drawn with the most recent search
            session_unset();
        ?>

        <form method="post" action="searchEOI.php">
            <fieldset>
                <legend class="center-text"><h2>Search EOIs</h2></legend>

                <div class="form-container">
                    <label for="jobRefNo_select" class="col-6">Job Reference Number<br>
                        <?php
                            // create a dropdown list for all job reference numbers
                            $query = "SELECT jobRefNo FROM eoi;";

                            $result = mysqli_query($conn, $query);

                            if(!$result){
                                echo "<p>Error: Something is wrong with query: ", $query, "</p>";
                            } else {
                                echo "<select id='jobRefNo_filter' name='jobRefNo_filter'>\n
                                        <option value='' selected>Any</option>\n";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<option value='", $row['jobRefNo'], "'>", $row['jobRefNo'], "</option>\n";
                                }
                                echo "</select>";
                            }
                        ?>
                    </label>
                    <aside class="col-6"></aside>

                    <label for="firstName_filter" class="col-6">Name
                        <input type="text" name="firstName_filter" id="firstName_filter" maxlength="20" placeholder="First Name">
                    </label>
                    <label for="lastName_filter" class="col-6">
                        <input type="text" name="lastName_filter" id="lastName_filter"maxlength="20" placeholder="Last Name">
                    </label>
                    <input type="submit" value="Search">
                </div>
            </fieldset>
        </form>

        <form method="post" action="deleteEOI.php">
            <fieldset>
                <legend class="center-text"><h2>Delete EOIs</h2></legend>

                <div class="form-container">
                    <label for="jobRefNo_select" class="col-6">Job Reference Number<br>
                        <?php
                            // create a dropdown list for all job reference numbers
                            $query = "SELECT jobRefNo FROM eoi;";

                            $result = mysqli_query($conn, $query);

                            if(!$result){
                                echo "<p>Error: Something is wrong with query: ", $query, "</p>";
                            } else {
                                echo "<select id='jobRefNo_filter' name='jobRefNo_filter' required>\n
                                        <option value='' selected>---</option>\n";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<option value='", $row['jobRefNo'], "'>", $row['jobRefNo'], "</option>\n";
                                }
                                echo "</select>";
                            }
                        ?>
                    </label>
                    <input type="submit" value="Delete">
                </div>
            </fieldset>
        </form>

    </section>

    <!--Footer-->
    <?php
        }
        include "include/footer.inc";
    ?>
</body>

</html>