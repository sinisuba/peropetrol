<?php

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "peropetrol";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if ($conn === false)
    exit("Greška pri povezivanju na DB '" . $dbName . "'" . mysqli_connect_error());

// echo("Uspješna konekcija; " . mysqli_get_host_info($conn));