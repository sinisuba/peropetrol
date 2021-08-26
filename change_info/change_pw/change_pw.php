<?php
    session_start();

    require "../../db/dbConn.php";

    if (!isset($_SESSION['role'])) // user not logged in
    {
        if (!empty($_POST['currentEmail']))
            $currentEmail = $_POST['currentEmail'];
        else exit("Unesite email!");
    }
    else $currentEmail = $_SESSION['email'];
    
    if (empty($_POST['currentPW']) || empty($_POST['newPW']) || empty($_POST['newPW_repeat']))
        exit("Popunite sva polja!");
    else
    {
        $currentPW = $_POST['currentPW'];
        $newPW = $_POST['newPW'];
        $newPW_repeat = $_POST['newPW_repeat'];
    }

    if (strlen($newPW) < 8)
        exit("Nova lozinka mora sadržati minimalno 8 karaktera!");

    if ($newPW_repeat !== $newPW)
        exit('Unesene lozinke se ne podudaraju!');

    if ($currentPW === $newPW)
        exit('Stara i nova lozinka se moraju razlikovati!');

    if (str_ends_with($currentEmail, "@peropetrol.com"))
    {
        $checkIfExists = "SELECT radnik_password FROM radnici WHERE radnik_email=?;";
        $setNewPW = "UPDATE radnici SET radnik_password = ? WHERE radnik_email = ?;";
        
        $korisnik = "radnik";
    }
    else
    {
        $checkIfExists = "SELECT korisnik_password FROM korisnici WHERE korisnik_email=?;";
        $setNewPW = "UPDATE korisnici SET korisnik_password = ? WHERE korisnik_email = ?;";

        $korisnik = "korisnik";
    }

    $statementCheckIfExists = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statementCheckIfExists, $checkIfExists))
    {
        mysqli_stmt_close($statementCheckIfExists);
        exit("Greška, pokušajte ponovo.");
    }
    else
    {
        mysqli_stmt_bind_param($statementCheckIfExists, "s", $currentEmail);

        mysqli_stmt_execute($statementCheckIfExists);

        $queryResult = mysqli_stmt_get_result($statementCheckIfExists);

        mysqli_stmt_close($statementCheckIfExists);

        $currentRow = mysqli_fetch_assoc($queryResult);

        if (mysqli_num_rows($queryResult))
        {
            if ($korisnik === "radnik")
                $hash = $currentRow['radnik_password'];
            else $hash = $currentRow['korisnik_password'];

            if (password_verify($currentPW, $hash))
            {
                $statementNewPW = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($statementNewPW, $setNewPW))
                    exit("Greška, pokušajte ponovo.");

                $newHash = password_hash($newPW, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($statementNewPW, "ss", $newHash, $currentEmail);

                mysqli_stmt_execute($statementNewPW);

                if (isset($_SESSION['role'])) // if the user is logged in and successfully changes password, destroy session
                {
                    session_unset();
                    session_destroy();
                }

                mysqli_stmt_close($statementNewPW);

                exit("OK");
            }
            else exit("Pogrešna lozinka!");
        }
        else exit("Uneseni email ne postoji!");
    }