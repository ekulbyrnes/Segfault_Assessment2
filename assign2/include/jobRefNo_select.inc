<?php
    // create a dropdown list for all job reference numbers
    $query = "SELECT jobRefNo FROM eoi;";

    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "<p>Error: Something is wrong with query: ", $query, "</p>";
    } else {
        echo "<select id='jobRefNo_filter' name='jobRefNo_filter'>\n"
            ."\t\t\t\t\t\t\t<option value=''>Any</option>\n";
        while($row = mysqli_fetch_array($result)){
            echo "\t\t\t\t\t\t\t<option value='", $row['jobRefNo'], "'>", $row['jobRefNo'], "</option>\n";
        }
        echo "\t\t\t\t\t\t</select>";
    }
?>