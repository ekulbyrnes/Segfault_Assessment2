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
    <header>
        <!--add php nav bar-->
    </header>

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


        <form method="post" action="search_eois.php">
            <label>
                Job Reference Number
                <input type="text" placeholder="00000">
            </label>
            <label>
                Name
                <input type="text" placeholder="First Name">
                <input type="text" placeholder="Last Name">
            </label>
            <input type="submit" placeholder="Search EOIs">
        </form>

        <form method="post" action="delete_eois.php">
            <label>
                Job Reference Number
                <input type="text" placeholder="00000">
            </label>
            <input type="submit" placeholder="Delete EOIs">
        </form>

        <?php

        ?>


    </section>

    <!--replace with php footer-->
    <section class="pagefooter">
        <img src="logo.png" alt="Segfault logo" width="300">
        <aside>
            <ul>
                <li><a href="mailto:100589839@student.swin.edu.au">&#9993; Mail Us</a></li>
            </ul>
        </aside>
    </section>

    <footer class="staticfooter center-text">
        <span>COS10032 Assignment One</span>
    </footer>
</body>

</html>
