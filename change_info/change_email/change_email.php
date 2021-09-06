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

    if (empty($_POST['currentPW']) || empty($_POST['newEmail']))
        exit("Popunite sva polja!");
    else
    {
        $currentPW = $_POST['currentPW'];
        $newEmail = $_POST['newEmail'];
    }

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL))
        exit("Uneseni email '$newEmail' nije validan!");

    if ($newEmail === $currentEmail)
        exit('Stari i novi mejl se moraju razlikovati!');

    if (substr($currentEmail, -15) === "@peropetrol.com")
    {
        if (substr($newEmail, -15) !== "@peropetrol.com")
            exit("Zaposleni PeroPetrola moraju koristiti domen 'peropetrol.com'");

        if (strpos($newEmail, "admin") !== false)
            exit('Zabranjen mejl!');

        $checkIfExists = "SELECT radnik_password FROM radnici WHERE radnik_email=?;";
        $setNewEmail = "UPDATE radnici SET radnik_email = ? WHERE radnik_email = ?;";

        $korisnik = "radnik";
    }
    else
    {
        if (substr($newEmail, -15) === "@peropetrol.com")
            exit("Domen 'peropetrol.com' je rezervisan za zaposlene PeroPetrola. <br> Molimo Vas da odaberete drugu email adresu.");

        $checkIfExists = "SELECT korisnik_password FROM korisnici WHERE korisnik_email=?;";
        $setNewEmail = "UPDATE korisnici SET korisnik_email = ? WHERE korisnik_email = ?;";

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
                $statementNewEmail = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($statementNewEmail, $setNewEmail))
                {
                    mysqli_stmt_close($statementNewEmail);
                    exit("Greška, pokušajte ponovo.");
                }

                mysqli_stmt_bind_param($statementNewEmail, "ss", $newEmail, $currentEmail);

                mysqli_stmt_execute($statementNewEmail);

                if (isset($_SESSION['role'])) // if the user is logged in and successfully changes email, destroy session
                {
                    session_unset();
                    session_destroy();
                }

                mysqli_stmt_close($statementNewEmail);

                exit("OK");
            }
            else
            {
                mysqli_stmt_close($statementNewEmail);
                exit("Pogrešna lozinka!");
            }
        }
        else
            exit("Uneseni email ne postoji!");
    }