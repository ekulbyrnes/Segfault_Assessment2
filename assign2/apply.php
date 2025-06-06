<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/header.inc";?>
    <title>Apply Now - SegFault Services</title>
</head>


<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>
    <!-- end of header -->

    <section class="slideshow center-flex">
        <h1>Apply</h1><br>
        <div>
            <p class="newline-flex"><span class="terminalblink">_</span>Join us at SegFault!</p>
        </div>
    </section>


    <!-- Application Form - Marcus -->
    <section class="focus"><!--class focus to create a margin around the main content-->
        <h1><span class="terminalblink">_</span>Application Form</h1>

        <!--Start of form-->
        <form id="application" method="post" action="processEOI.php" novalidate="novalidate"><!--Form posts data to the swinburne mercury test server-->
            <fieldset><!--This fieldset wraps around the entire form-->
                <legend class="center-text"><h2>Applicant Details</h2></legend>

                <div class="form-container"><!--Open flex container for the layout of form items-->
                    <!--The flex container is treated as if it has 12 columns-->
                    <!--class "col-12" on the label element that wraps the input to make both elements take up the space of the first row of the flex container-->

                    <label for="jobRefNo" class="col-6">Job reference number<br><!--Label using "for" attribute linking it to its input-->
                        <input type="text" name="jobRefNo" id="jobRefNo" disabledpattern="\d{5}" maxlength="5" required><!--Text input with pattern validating that the input has exactly 5 digits-->
                    </label>
                    <!--Empty element with class "col-6" to complete first row-->
                    <aside class="col-6"></aside>
    <!--blank line between each "row" of flex items-->

                    <label for="firstName" class="col-6">Name
                    <!--Text input with regex validating between 1 and 20 letters. Using "(?:\s*\-*[a-zA-Z]){1,20}" allows the user to input spaces or dashes for multi-word names -->
                        <input type="text" name="firstName" id="firstName" disabledpattern="(?:\s*\-*[a-zA-Z]){1,20}" maxlength="20" placeholder="First Name" required>
                    </label>
                    <label for="lastName" class="col-6">
                        <input type="text" name="lastName" id="lastName" disabledpattern="(?:\s*\-*[a-zA-Z]){1,20}" maxlength="20" placeholder="Last Name" required>
                    </label>

                    <label for="DOB" class="col-6">Date of birth
                        <input type="text" name="DOB" id="DOB" placeholder="dd/mm/yyyy"required>
                    </label>

                    <!--IMPORTANT! ask davi if this use of div is acceptable-->
                    <div class="col-6"><!--Contain entire gender fieldset in a flex-item-->
                        <fieldset id="genderFieldset" ><!--Fieldset containing all gender items-->
                            <legend><h4>Gender</h4></legend>
                            <div class="gender-flex-container"><!--Flex container containing all gender items-->
                                <label for="female" class="gender-flex-item" ><!--Flex item ensuring that the radio input and label for "Female" wrap at the same time-->
                                    <input type="radio" name="gender" value="2" id="female" required>
                                    Female
                                </label>
                                <label for="male" class="gender-flex-item">
                                    <input type="radio" name="gender" value="1" id="male">
                                    Male
                                </label>

                                <span class="flex-break"></span><!--Span with class "flex-break" fills the remaining width of the current row, forcing a new row-->
                                <label for="other" class="gender-flex-item">
                                    <input type="radio" name="gender" value="3" id="other">
                                    Other:
                                </label>
                                <!--Flex item ensuring the gender text input remains large enough to use-->
                                <input type="text" name="othergender" id="othergender" disabledpattern="[a-zA-Z -]{1,20}">
                            </div>
                        </fieldset>
                    </div>

                    <!--Full row flex item to contain address heading-->
                    <h3 class="col-12">Address</h3>

                    <label class="col-12" for="address">Street Address
                        <input type="text" name="address" id="address" disabledpattern=".{1,40}" maxlength="40" required><!--Text input with regex validating any pattern between 1 and 40 characters-->
                    </label>

                    <label class="col-6" for="suburb">Suburb
                        <input type="text" name="suburb" id="suburb" disabledpattern=".{1,40}" maxlength="40" required>
                    </label>

                    <label class="col-4" for="postcode">Postcode<!--Flex item with column width of 4 to give space for the "state" dropdown on the same line-->
                        <input type="text" name="postcode" id="postcode" disabledpattern="\d{4}" maxlength="4" required><!--Text input with regex validating exactly 4 digits-->
                    </label>
                    <!--Flex item with a column width of 2 containing the "state" dropdown-->
                    <label class="col-2" for="state">State<br>
                        <select name="state" id="state" required>
                            <option value="">---</option><!--Placeholder option, needed due to the select element having the attribute "required"-->
                            <option value="VIC">VIC</option>
                            <option value="NSW">NSW</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="TAS">ACT</option>
                        </select>
                    </label>

                    <label class="col-6" for="phonenumber">Phone Number
                        <!--Text input with regex validating between 8 and 12 digits with any number of spaces inbetween-->
                        <input type="text" name="phonenumber" id="phonenumber" disabledpattern="(?:\s*\d){8,12}" required>
                    </label>

                    <label class="col-6" for="email">Email Address
                        <input type="text" name="email" id="email" required>
                    </label>

                    <h3 class="col-12">Skills</h3>

                    <!--Check boxes for skills-->
                    <label class="col-2" for="skill_java">
                        <input type="checkbox" name="skill_java" value="skill_java" id="skill_java">
                        Java
                    </label>
                    <label class="col-2" for="skill_cpp">
                        <input type="checkbox" name="skill_cpp" value="skill_cpp" id="skill_cpp">
                        C++
                    </label>
                    <label class="col-2" for="skill_php">
                        <input type="checkbox" name="skill_php" value="skill_php" id="skill_php">
                        PHP
                    </label>
                    <label class="col-2" for="skill_sql">
                        <input type="checkbox" name="skill_sql" value="skill_sql" id="skill_sql">
                        MySQL
                    </label>
                    <label class="col-2" for="skill_python">
                        <input type="checkbox" name="skill_python" value="skill_python" id="skill_python">
                        Python
                    </label>
                    <label class="col-2" for="skill_other">
                        <input type="checkbox" name="skill_other" value="skill_other" id="skill_other">
                        Other
                    </label>

                    <textarea class="col-12" name="skill_other_details" id="skill_other_details" placeholder="Other skills..." rows="8" cols="70"></textarea>

                    <input class="col-12" type="submit" value="Apply"><!--Button to submit form-->
                </div>
            </fieldset>
        </form>
    </section>

    <!-- Footer -->
    <?php include "include/footer.inc";?>

</body>
</html>