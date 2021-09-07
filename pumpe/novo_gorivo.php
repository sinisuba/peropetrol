<?php
    session_start();

    if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "radnik") 
        header("Location: https://localhost/peropetrol/");

    require "../db/dbConn.php";

    if ($_SESSION['role'] === "admin")
    {
        if (empty($_POST['lokacija']))
            exit("Unesite lokaciju pumpe!");
        else 
            $lokacija = $_POST['lokacija'];

        if (!in_array($lokacija, ["Obilićevo", "Starčevica", "Petrićevac"]))
            exit("Odaberite jednu od ponuđenih pumpi!");
    }
    else if ($_SESSION['role'] === "radnik")
    {
        include "get_radnik_location.php"; // $radnikLocation
        $lokacija = $radnikLocation;
    }

    if (!isset($_POST['gorivo_naziv']) || !isset($_POST['gorivo_kolicina']))
        exit("Unesite naziv i količinu goriva!");
    else
    {
        $gorivo_naziv = mysqli_real_escape_string($conn, $_POST['gorivo_naziv']);
        $gorivo_kolicina = $_POST['gorivo_kolicina'];
    }

    if ($gorivo_kolicina < 0)
        exit("Količina goriva ne može biti negativna!");
    
    $addColumnGorivo = "ALTER TABLE pumpe ADD COLUMN $gorivo_naziv MEDIUMINT UNSIGNED NOT NULL;";
    $setGorivoKolicina = "UPDATE pumpe SET $gorivo_naziv = ? WHERE lokacija = ?;";

    $statement = mysqli_stmt_init($conn);
    
    if (!mysqli_query($conn, $addColumnGorivo))
        exit("Gorivo već postoji!");
    else if (!mysqli_stmt_prepare($statement, $setGorivoKolicina))
    {
        mysqli_stmt_close($statement);
        exit("Greška, pokušajte ponovo.");
    }
    else
    {
        mysqli_stmt_bind_param($statement, "is", $gorivo_kolicina, $lokacija);
        
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_close($statement);
            exit("OK");
        }
    }