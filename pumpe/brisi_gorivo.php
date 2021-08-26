<?php
    session_start();

    if ($_SESSION['role'] !== "admin") 
        header("Location: https://localhost/peropetrol/");

    require "../db/dbConn.php";

    if (empty($_POST['gorivo_naziv']))
        exit("Unesite naziv goriva!");
    else $gorivo_naziv = mysqli_real_escape_string($conn, $_POST['gorivo_naziv']);

    $sqlQuery = "ALTER TABLE pumpe DROP COLUMN $gorivo_naziv;";

    if (!mysqli_query($conn, $sqlQuery))
        exit("Uneseno gorivo ne postoji!");
    else exit("OK");