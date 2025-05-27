<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/header.inc";?>
    <title>PHP Enhancements - SegFault Services</title>
</head>


<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>

    <section class="slideshow center-flex">
        <h1>PHP Enhancements</h1><br>
    </section>


    <section class="focus center-text">
        <h3>Objective</h3>
        <p>On this page, our objective is to <em>list and describe</em> our php enhancements.</p>
        <h5>We will aim to show:</h5>
        <ul class="no-list-decor">
            <li>How it goes beyond the basic requirements of this assignment,</li>
            <li>What code is needed to implement the feature,</li>
        </ul>
        <p>Because of this, we may refer you to alternate sections of the site tree with id tags, allowing you
        to focus on the specific piece of content to be assesed.</p>

    </section>
    <section class="focus"> <!--Enhancements List-->
        <h3 class="center-text">Enhancements Section</h3>
        <div class="details-flex centertext" >
            <aside class="left-item">
                <h4>Auto-Populating Dropdown List</h4>
                <h6 class="pulse"><a href="manage.php#jobRefNo_filter" class="no-link-decor">[Click to go to Enhancement (#jobRefNo_filter)]</a></h6>
                <p>On our manage EOIs page, we created an dropdown list that automatically fills its options with job reference numbers from the database. 
                    Any duplicate reference numbers are removed.</p>
                <pre class="code-block">

// Fill an array of all job ref numbers from the database
<span>unset</span>($array);
$array = [];
$i = 0;
<span>while</span>($row = <span>mysqli_fetch_array</span>($result)){
    $array[$i] = $row['jobRefNo'];
    $i++;
}
// Cull duplicate job ref numbers from the array
$array = <span>array_unique</span>($array);
$array = <span>array_values</span>($array);
// Echo the array
$arraysize = <span>sizeof</span>($array, SORT_STRING);
<span>for</span>($i = 0; $i < $arraysize; $i++){
?&#62;&#60;option value='&#60;?php echo "$array[$i]" ?&#62;'&#62; &#60;?php echo "$array[$i]" ?&#62;&#60;/option&#62;
&#60;?php \}
                </pre>
            </aside>
            <aside class="right-item">
                <h4>Check Boxes to Filter EOIs</h4>
                <h6 class="pulse"><a href="manage.php#skill_java_filter" class="no-link-decor">[Click to go to Enhancement (#skill_java_filter)]</a></h6>
                <p>We also added checkboxes to filter EOIs by the skills an applicant has. 
                    They work very similarly to the filters for reference number and name.
                </p>
                <pre class="code-block">

                </pre>
            </aside>
        </div>
    </section>

    <?php include "include/footer.inc";?>
</body>
</html>
