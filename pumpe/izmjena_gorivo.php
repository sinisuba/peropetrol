<?php
    session_start();

    if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "radnik")
        header("Location: https://localhost/peropetrol/");

    require "../db/dbConn.php";

    $lokacija = $_POST['selectedLocation'];

    if (!isset($_POST['gorivo_naziv']) || !isset($_POST['gorivo_kolicina']))
        exit("Unesite naziv i količinu goriva!");
    else
    {
        $gorivo_naziv = mysqli_real_escape_string($conn, $_POST['gorivo_naziv']);
        $gorivo_kolicina = $_POST['gorivo_kolicina'];
    }

    if ($gorivo_kolicina < 0)
        exit("Količina goriva ne može biti negativna!");

    $checkIfGorivoExists = "SELECT $gorivo_naziv FROM pumpe;";

    if (mysqli_query($conn, $checkIfGorivoExists))
    {
        $sqlQuery = "UPDATE pumpe SET $gorivo_naziv = ? WHERE lokacija = ?;";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
            exit("Greška, pokušajte ponovo.");
        
        mysqli_stmt_bind_param($statement, "is", $gorivo_kolicina, $lokacija);

        mysqli_stmt_execute($statement);

        mysqli_stmt_close($statement);
        
        exit("OK");
    } else exit("Gorivo '$gorivo_naziv' ne postoji!");