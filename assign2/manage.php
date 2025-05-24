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


        <form method="post" action="processmanage.php">
            <label>
                Job Reference Number
                <?php
                    include "include/jobRefNo_select.inc";
                ?>
            </label>
            <label>
                Name
                <input type="text" id="firstName_filter" name='firstName_filter' placeholder="First Name">
                <input type="text" id="lastName_filter" name='lastName_filter' placeholder="Last Name">
            </label>
            <input type="submit" placeholder="Search EOIs">
        </form>

        <form method="post" action="deleteEOI.php">
            <label>
                Job Reference Number
                <?php
                    include "include/jobRefNo_select.inc";
                ?>
            </label>
            <input type="submit" placeholder="Delete EOIs">
        </form>

        <?php
            // open session
            session_start();
            // if EOI table set
            if(isset($_SESSION["EOItable"])){
                $EOItable = $_SESSION["EOItable"];
                echo "$EOItable";
            }
        ?>


    </section>

    <!--Footer-->
    <?php
        }
        include "include/footer.inc";
    ?>
</body>

</html>