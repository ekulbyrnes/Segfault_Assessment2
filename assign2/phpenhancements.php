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
                <h6 class="pulse"><a href="manage.php#enhancement_3" class="no-link-decor">[Click to go to Enhancement (#enhancement_3)]</a></h6>
                <p>On our manage EOIs page, we created an dropdown list that automatically fills its options with job reference numbers from the database. 
                    Any duplicate reference numbers are removed.</p>
                <pre class="code-block">

<span><strong>In jobRefNo_options.inc</strong></span>
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
<span>for</span>($i = 0; $i &#60; $arraysize; $i++){
<span>?</span>&#62;&#60;<span>option</span> value='&#60;<span>?php echo</span> "$array[$i]" <span>?</span>&#62;'&#62; &#60;<span>?php echo</span> "$array[$i]" <span>?</span>&#62;&#60;/<span>option</span>&#62;
&#60;<span>?php</span> \}

<span><strong>In manage.php</strong></span>       
// create a dropdown list for all job reference numbers
$query = "SELECT jobRefNo FROM eoi;";

$result = <span>mysqli_query</span>($conn, $query);

<span>if</span>(!$result){
    <span>echo</span> "&#60;p&#62;Error: Something is wrong with query: ", $query, "&#60;/p&#62;";
} <span>else</span> {
    <span>echo</span> "&#60;select id='jobRefNo_filter' name='jobRefNo_filter'&#62;\n
            &#60;option value='' selected&#62;Any&#60;/option&#62;\n";
    <span>include</span> "include/jobRefNo_options.inc";
    <span>echo</span> "&#60;/select&#62;";
}                    
                </pre>
            </aside>
            <aside class="right-item">
                <h4>Check Boxes to Filter EOIs</h4>
                <h6 class="pulse"><a href="manage.php#enhancement_4" class="no-link-decor">[Click to go to Enhancement (#enhancement_4)]</a></h6>
                <p>We also added checkboxes to filter EOIs by the skills an applicant has. 
                    They work very similarly to the filters for reference number and name.
                </p>
                <pre class="code-block">

<span><strong>In manage.php</strong></span>
&#60;<span>label</span> class="col-2" for="skill_java_filter"&#62;
    &#60;<span>input</span> type="checkbox" name="skill_java_filter" value="1" id="skill_java_filter"&#62;
    Java
&#60;/<span>label</span>&#62;

<span><strong>In searchEOI.php</strong></span>
$query = "  <span>SELECT</span> * <span>FROM</span> eoi <span>WHERE</span>
            jobRefNo <span>LIKE</span> '$jobRefNo_filter%'
            <span>AND</span> firstName <span>LIKE</span> '$firstName_filter%'
            <span>AND</span> lastName <span>LIKE</span> '$lastName_filter%'
            <span>AND</span> skill_java <span>LIKE</span> '$skill_java_filter%'
            <span>AND</span> skill_cpp <span>LIKE</span> '$skill_cpp_filter%'
            <span>AND</span> skill_php <span>LIKE</span> '$skill_php_filter%'
            <span>AND</span> skill_sql <span>LIKE</span> '$skill_sql_filter%'
            <span>AND</span> skill_python <span>LIKE</span> '$skill_python_filter%'
            <span>AND</span> skill_other <span>LIKE</span> '$skill_other_filter%'
            ;";

$result = <span>mysqli_query</span>($conn, $query);
                </pre>
            </aside>
        </div>
    </section>

    <?php include "include/footer.inc";?>
</body>
</html>
