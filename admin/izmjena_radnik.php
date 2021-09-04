<?php
    session_start();

    if ($_SESSION['role'] !== "admin")
        header("Location: https://localhost/peropetrol/");

    require "../db/dbConn.php";

    $sqlQuery = "UPDATE radnici SET ";
    $types = "";
    $parameters = array();

    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['staz']) || empty($_POST['plata']) || empty($_POST['godisnji']) || empty($_POST['pumpa']))
        exit("Popunite sva polja (osim lozinke)!");
    else
    {
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            exit("Uneseni email '$email' nije validan!");

        if (!str_ends_with($email, "@peropetrol.com"))
            exit("Radnici moraju koristiti domen 'peropetrol.com'");

        if ($_POST['staz'] < 0)
            exit("Staž ne može biti negativan!");

        if ($_POST['plata'] < 0)
            exit("Plata ne može biti negativna!");

        if ($_POST['godisnji'] < 0)
            exit("Godišnji odmor ne može biti negativan!");

        if (!in_array($_POST['pumpa'], ["Obilićevo", "Starčevica", "Petrićevac"]))
            exit("Odaberite jednu od ponuđenih pumpi!");

        $sqlQuery .= "ime = ?, prezime = ?, radnik_email = ?, staz = ?, plata = ?, godisnji = ?, pumpa = ?";
        $types = "sssidis"; // string, int, double

        $parameters = [$_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['staz'], $_POST['plata'], $_POST['godisnji'], $_POST['pumpa']];

        if (!empty($_POST['password']))
        {
            $password = $_POST['password'];
            if (strlen($password) < 8)
                exit("Lozinka mora sadržati minimalno 8 karaktera!");

            $sqlQuery .= ", radnik_password = ?";
            $types .= "s";
            $parameters[] = password_hash($password, PASSWORD_DEFAULT);
        }

        $sqlQuery .= " WHERE radnik_email = ?;";
        $types .= "s";
        $parameters[] = $_POST['selectedUserEmail'];

        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $sqlQuery))
        {
            mysqli_stmt_bind_param($statement, $types, ...$parameters); // '...' => splat operator, can pass in parameters as an array

            mysqli_stmt_execute($statement);

            if (mysqli_stmt_affected_rows($statement) > 0)
            {
                mysqli_stmt_close($statement);
                exit("OK");
            }
            else
            {
                mysqli_stmt_close($statement);
                exit("Podaci su nepromijenjeni.");
            }
        }
        else
        {
            mysqli_stmt_close($statement);
            exit("Greška, pokušajte ponovo.");
        }
    }