<?php
    session_start();

    if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "radnik")
    {
        $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

        header("Location: $redirect");
    }

    require "../db/dbConn.php";

    $lokacija = $_POST['lokacija'];
    $fuelCount = count($_POST) - 1; // skip $lokacija

    foreach ($_POST as $gorivo_naziv => $gorivo_kolicina)
    {
        if ($fuelCount-- === 0)
            exit("OK");

        if ($gorivo_kolicina < 0)
            $gorivo_kolicina = 0;

        $sqlQuery = "UPDATE pumpe SET $gorivo_naziv = ? WHERE lokacija = ?;";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
            exit("Greška, pokušajte ponovo.");
        mysqli_stmt_bind_param($statement, "is", $gorivo_kolicina, $lokacija);

        mysqli_stmt_execute($statement);

        mysqli_stmt_close($statement);
    }