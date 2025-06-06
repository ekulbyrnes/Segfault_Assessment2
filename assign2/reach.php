<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/header.inc";?>
    <title>Reach Out - SegFault Services</title>
</head>
<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>
    <!-- end of header -->

    <section class="slideshow center-flex">
        <h1>Reach Out</h1><br>
        <div>
            <p class="newline-flex"><span class="terminalblink">_</span>Got a skill that might be useful?<br><em>We might not have even thought about it yet!</em>.</p>
        </div>
    </section>
    <!-- Element below and contents Completed by (lbyrnes)-->
    <article>
        <section>
            <h1><span class="terminalblink">_</span>Did we miss something?</h1>
            <p>Tell us about what you could bring to the team, and let's see if we have a shared vision.</p>
            <p><img class="infoLogo" src ="./images/logo.png" alt="logo" width="200">are always looking for switched-on individuals who can: </p>
            <ul class="underscore">
                <li>Anticipate problems before they occur</li>
                <li>Plan early, and update often</li>
                <li>Understand the core focus of our business is people, regardless of the technologies involved</li>
            </ul>
            <p class="center-text">Think you have what it takes? <strong>Be bold</strong> and reach out!</p>
        </section>
        <section class="stub">
            <p>Don't be afraid - we're just as human as you are, and we're looking to provide the best service to our customers that our team can provide.</p>
            <p>If your idea works for our mutual benefit, we'd love to hear from you!</p>
        </section>
        <section>
        <!--Start of EOI form (lbyrnes) - structure copied and adjusted from Marcus's apply.html form, with elements updated and additional parameters added. -->
            <form id="reach-out" method="post" action="https://mercury.swin.edu.au/it000000/formtest.php"><!--Form posts data to the swinburne mercury test server-->
                <fieldset class=""><!-- contain the form elements-->
                    <legend class="center-text"><h2>Tell us what you can do</h2></legend><!-- Title of form -->
                    <div class="form-container"><!-- Duplicate of Apply form. Open flex container for the layout of form items-->
                        <!--The flex container is treated as if it has 12 columns-->
                        <!--class "col-12" on the label element that wraps the input to make both elements take up the space of the first row of the flex container-->
                        <label for="firstName" class="col-6">Name
                        <!--Text input with regex validating between 1 and 20 letters. Using "[\p{Letter}\p{Mark} ]" to allow special characters from other languages but not numbers or symbols-->
                            <input type="text" name="firstName" id="firstName" pattern="(?:\s*\-*[a-zA-Z]){1,20}" maxlength="20" placeholder="First Name" required>
                        </label>
                        <input class="col-6" type="text" name="lastName" id="lastName" pattern="(?:\s*\-*[a-zA-Z]){1,20}" maxlength="20" placeholder="Last Name" required>
                        <!-- Update phone prompts -->
                        <label class="" for="phonenumber">Call me on
                            <input type="text" name="phonenumber" id="phonenumber" pattern="(?:\s*\d){8,12}" placeholder="+61" required><!--Text input with regex validating between 8 and 12 digits with any number of spaces inbetween-->
                        </label>
                        <!-- Update email prompts -->
                        <label class="col-6" for="email">Email me at
                            <input type="email" name="email" id="email" placeholder="myname@example.com" required>
                        </label>
                        <!-- Skill and value section -->
                        <h3 class="col-12">Skills and Value</h3>
                        <!--Flex item with a column width of 10 containing the "What do you bring to Segfault form" dropdown-->
                        <label class="col-10" for="state">Where are you at?<br>
                            <select name="state" id="state" required>
                                <option value="">---</option><!--Placeholder option, needed due to the select element having the attribute "required"-->
                                <!-- Updated option sequence by lbyrnes -->
                                <option value="NewStarter">I'm new to the industry and I'd like to get some experience.</option>
                                <option value="BringingClients">I think Segfault can help some businesses I know/work with, and we should talk about how I can help with that.</option>
                                <option value="OldHat">I'm a skilled-hand and have seen a lot - my insight could make Segfault more competitive.</option>
                                <option value="GeniusHacker">I know this field inside out and you'd be missing out if I wasn't working at Segfault.</option>
                                <option value="SomethingElse">I'm equally bold, but these don't match my vibe... I have detailed something else to offer below!</option>
                            </select>
                        </label>
                        <!-- renamed and relabelled elements from apply.html by lbyrnes -->
                        <textarea class="col-12" name="motivation-details" id="motivation-details" placeholder="Segfault would benefit from my contributions because..." rows="12" cols="70"></textarea>
                        <h2 class="col-12">I have mastered...</h2>
                        <!--Check boxes for skills-->
                        <label class="col-2" for="skill-java">
                            <input type="checkbox" name="skill-java" value="skill-java" id="skill-java">
                            Java
                        </label>
                        <label class="col-2" for="skill-cpp">
                                <input type="checkbox" name="skill-cpp" value="skill-cpp" id="skill-cpp">
                                C++
                        </label>
                        <label class="col-2" for="skill-php">
                                <input type="checkbox" name="skill-php" value="skill-php" id="skill-php">
                                PHP
                        </label>
                        <label class="col-2" for="skill-python">
                                <input type="checkbox" name="skill-python" value="skill-python" id="skill-python">
                                Python
                        </label>
                        <label class="col-2" for="skill-sql">
                                <input type="checkbox" name="skill-sql" value="skill-sql" id="skill-sql">
                                MySQL
                        </label>
                        <label class="col-2" for="skill-postgres">
                                <input type="checkbox" name="skill-postgres" value="skill-postgres" id="skill-postgres">
                                Postgres
                        </label>
                        <label class="col-10" for="skill-other">
                                <input type="checkbox" name="skill-other" value="skill-other" id="skill-other">
                                Other - let me tell you below!
                        </label>

                        <textarea class="col-12" name="skill-other-details" id="skill-other-details" placeholder="Show us what you got..." rows="12" cols="70"></textarea>

                        <input class="col-12" type="submit" value="This is what I got."><!--Button to submit form-->
                    </div>
                </fieldset>
            </form>
        </section>
    </article>
    <!-- end of block-level lbyrnes contribution for this page -->
     
    <!-- Footer -->
    <?php include "include/footer.inc";?>

</body>
</html>
