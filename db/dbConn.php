<?php

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "peropetrol";

// WampServer supports both MariaDB and MySQL. If only one DB engine is enabled, there's no need to specify a port.
// Otherwise, a port must be specified for the connection to be established (Default ports: MySQL '3306', MariaDB '3307').
// Example for WampServer & MariaDB: $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName, '3307');
// Since XAMPP only supports MariaDB there's no need to specify a port.
$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

// Default WampServer charset: 'latin1'
// Default XAMPP charset: 'utf8mb4'
// WampServer charset after mysqli_set_charset: 'utf8mb4'
// In order for the application to work properly while using WampServer, the charset needs to be changed to 'utf8mb4'.
// XAMPP's default charset is set to 'utf8mb4', so the next step can be avoided.
mysqli_set_charset($conn, "utf8mb4");

if ($conn === false)
    exit("Greška pri povezivanju na DB '" . $dbName . "' - " . mysqli_connect_error());

// echo("Uspješna konekcija; " . mysqli_get_host_info($conn));
