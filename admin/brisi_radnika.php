<?php
    session_start();

    if ($_SESSION['role'] !== "admin")
    {
        $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

        header("Location: $redirect");
    }

    require "../db/dbConn.php";

    $radnik_email = $_POST['radnik_email'];

    $sqlQuery = 'DELETE FROM radnici WHERE radnik_email=?;';

    $statement = mysqli_stmt_init($conn);
    
    if (mysqli_stmt_prepare($statement, $sqlQuery))
    {
        mysqli_stmt_bind_param($statement, "s", $radnik_email);

        mysqli_stmt_execute($statement);

        if (mysqli_stmt_affected_rows($statement) > 0)
        {
            mysqli_stmt_close($statement);
            exit("OK");
        }
    }
    else
    {
        mysqli_stmt_close($statement);
        exit("Greška, pokušajte ponovo.");
    }