<?php
    // Fill an array of all job ref numbers from the database
    unset($array);
    $array = [];
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $array[$i] = $row['jobRefNo'];
        $i++;
    }
    // Cull duplicate job ref numbers from the array
    $array = array_unique($array);
    $array = array_values($array);
    // Echo the array
    $arraysize = sizeof($array, SORT_STRING);
    for($i = 0; $i < $arraysize; $i++){
        echo "\t\t\t\t\t\t\t<option value='", $array[$i], "'>", $array[$i], "</option>\n";
    }
?>