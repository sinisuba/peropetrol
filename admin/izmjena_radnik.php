<?php
    session_start();
    
    if ($_SESSION['role'] !== "admin")
        header("Location: https://localhost/peropetrol/");

    require "../db/dbConn.php";

    $sqlQuery = "UPDATE radnici SET ";
    $types = "";
    $parameters = array();

    if (!empty($_POST['firstname']))
    {
        $firstname = $_POST['firstname'];
        
        $sqlQuery .= "ime = ?,";
        $types .= "s";
        $parameters[] = $firstname;
    }

    if (!empty($_POST['lastname']))
    {
        $lastname = $_POST['lastname'];

        $sqlQuery .= "prezime = ?,";
        $types .= "s";
        $parameters[] = $lastname;
    }

    if (!empty($_POST['email']))
    {
        $email = $_POST['email'];
        if (!str_ends_with($email, "@peropetrol.com"))
            exit("Radnici moraju koristiti domen 'peropetrol.com'");

        $sqlQuery .= "radnik_email = ?,";
        $types .= "s";
        $parameters[] = $email;
    }

    if (!empty($_POST['password']))
    {
        $password = $_POST['password'];
        if (strlen($password) < 8)
            exit("Lozinka mora sadržati minimalno 8 karaktera!");
        
        $sqlQuery .= "radnik_password = ?,";
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $types .= "s";
        $parameters[] = $hash;
    }

    if (!empty($_POST['staz']))
    {
        $staz = $_POST['staz'];
        if ($staz < 0)
            exit("Staž ne može biti negativan!");

        $sqlQuery .= "staz = ?,";
        $types .= "i";
        $parameters[] = $staz;
    }

    if (!empty($_POST['plata']))
    {
        $plata = $_POST['plata'];
        if ($plata < 0)
            exit("Plata ne može biti negativna!");

        $sqlQuery .= "plata = ?,";
        $types .= "d";
        $parameters[] = $plata;
    }

    if (!empty($_POST['godisnji']))
    {
        $godisnji = $_POST['godisnji'];
        if ($godisnji < 0)
            exit("Godišnji odmor ne može biti negativan!");

        $sqlQuery .= "godisnji = ?,";
        $types .= "i";
        $parameters[] = $godisnji;
    }

    if (!empty($_POST['pumpa']))
    {
        $pumpa = $_POST['pumpa'];
        if (!in_array($pumpa, ["Obilićevo", "Starčevica", "Petrićevac"]))
            exit("Odaberite jednu od ponuđenih pumpi!");

        $sqlQuery .= "pumpa = ?,";
        $types .= "s";
        $parameters[] = $pumpa;
    }

    if (count($parameters) > 0)
    {
        $sqlQuery = substr($sqlQuery, 0, -1); // drop last comma

        $sqlQuery .= " WHERE radnik_email = ?;";
        $types .= "s";
        $parameters[] = $_POST['selectedUserEmail'];

        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $sqlQuery))
        {
            mysqli_stmt_bind_param($statement, $types, ...$parameters); // '...' => splat operator, can pass in parameters as an array

            mysqli_stmt_execute($statement);
            
            if (mysqli_affected_rows($conn) > 0)
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
    else
    {
        mysqli_stmt_close($statement);
        exit("Unesite podatke!");
    }