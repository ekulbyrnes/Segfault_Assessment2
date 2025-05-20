<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="SegFault Services">
    <meta name="charset" content="utf-8">
    <meta name="keywords" content="computing, recruiting, services">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This website is a group project for class COS10032. It is a job board project.">

    
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <title>Segfault Services</title>
</head>


<body>
    <!-- Header with aside logo and navbar - Nicole -->
    <?php
        include "include/header.inc";
    ?>
    <!-- end of header -->

    <!-- Vandy - Section on Index.html -->
    <div class="slideshow center-flex"><!-- Banner section -->
        <h1>Welcome!</h1><br>
        <p><span class="terminalblink">_</span>We are currently hiring! <br> There is available job below</p>
    </div>

    <section class="focus" id="siteInfo">
        <p id="info"><img class="infoLogo" src="./images/logo.png" alt="logo"> is a professional services company in the tech industry,
            designed to connect skilled professionals with interesting projects around the Asia-Pacfic region. We're well known for our tool <strong><em>Eyeglass</em></strong>,
            a SIEM (Security Information and Event Management) tool that allows IT teams understand the landscape of their networks and stay aware of
            their security landscape. We strive on being a place for innovation. Segfault ensures a seamless experience for both our staff and our
            partners to win in the information space. As the platform grows, we will continue to expand our offerings and features, making it a
            go-to resource for tech professionals seeking new opportunities.
        </p>
        <p><strong><em>Check out what we are about below!<br>There might be something that interests you in our jobs listings.</em></strong></p>
    </section>
    <section class="focus center-text">
    <embed src="https://www.youtube.com/embed/46mrM8aR24E?si=d7NQkm3qRX2ggB8G">
    </section>
    <section id="achieved">
        <div class="achievement" id="happyWorker">
            <h3 id="worker">4+</h3>
            <p class="child1"><strong>Happy Workers</strong></p>
            <p class="child2">And still counting</p>
        </div>
        <div class="achievement" id="No1">
            <h3 id="number1">&#127942;</h3>
            <p class="child1"><strong>Swinburne No.1</strong></p>
            <p class="child2">Security Developer</p>

        </div>
    </section>

    <h2 class="heading2">How to start</h2>
    <section id="howToStart">
        <div id="signUp">
            <h3 class="heading3"><span>&#128393;</span> Sign Up</h3>
            <p>Head over to our <a href="apply.html" class="no-link-decor"><strong>form</strong></a> to get across any updates from us.</p>
            <p>We promise, no spam!</p>
        </div>
        <div id="resume">
            <h3 class="heading3"><span>&#128221;</span> Who We Are</h3>
            <p>Check out <a href="about.html" class="no-link-decor"><strong>our staff</strong></a> here at SegFault.</p>
            <p>Get to know our amazing team here!</p>
        </div>
        <div id="looking">
            <h3 class="heading3"><span>&#128270;</span> Looking?</h3>
            <p>Our <a href="jobs.html" class="no-link-decor"><strong>jobs page</strong></a> has details of our lists available.</p>
            <p>RSS feed coming soon (maybe)!</p>
        </div>
    </section>

    <h2 class="heading2">Available Position</h2>
    <section id="job">
        <a class="job-link" href="jobs.html">
            <div id="job1">
                <h2>Kotlin Developer</h2>
            </div>
        </a>
        <a class="job-link" href="jobs.html">
            <div id="job2">
                <h2>Site Reliability Engineer</h2>
            </div>
        </a>
    </section>
    <!-- Vandy -->

    <!-- Footer -->
    <?php
        include "include/footer.inc";
    ?>

</body>
</html>
