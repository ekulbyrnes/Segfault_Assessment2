<?php
	$host = "feenix-mariadb.swin.edu.au";
	$user = "s7194587"; // your user name
	$pwd = "070789"; // your password (date of birth ddmmyy unless changed)
	$sql_db = "s7194587_db"; // your database

    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
?>