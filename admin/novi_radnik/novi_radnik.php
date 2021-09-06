<?php
    session_start();

    if ($_SESSION['role'] !== "admin")
        header("Location: https://localhost/peropetrol/");

    require "../../db/dbConn.php";

    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_repeat']) || empty($_POST['pumpa']))
        exit("Popunite sva polja označena sa *!");
    else
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_repeat = $_POST['password_repeat'];
        $pumpa = $_POST['pumpa'];
    }

    // grab optional parameters if entered
    if (is_numeric($_POST['staz']))
        $staz = $_POST['staz'];
    if (is_numeric($_POST['plata']))
        $plata = $_POST['plata'];
    if (is_numeric($_POST['godisnji']))
        $godisnji = $_POST['godisnji'];

    if (strlen($password) < 8)
        exit("Lozinka mora sadržati minimalno 8 karaktera!");
    else if ($password !== $password_repeat)
        exit("Unesene lozinke se ne podudaraju!");
    else if (substr($email, -15) !== "@peropetrol.com")
        exit("Radnici moraju koristiti domen 'peropetrol.com'");
    else if (!in_array($pumpa, ["Obilićevo", "Starčevica", "Petrićevac"]))
        exit("Odaberite jednu od ponuđenih pumpi!");
    else if (strpos($email, "admin") !== false)
        exit("Zabranjen mejl!");
    else
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sqlQuery = "INSERT INTO radnici(ime, prezime, radnik_email, radnik_password";
        $values = " VALUES (?, ?, ?, ?";
        $types = "ssss";
        $parameters = array($firstname, $lastname, $email, $hash);
        
        // optional parameters
        if (isset($staz))
        {
            if ($staz < 0)
                exit("Staž ne može biti negativan!");
            
            $sqlQuery .= ", staz";
            $types .= "i";
            $values .= ", ?";
            $parameters[] = $staz;
        }

        if (isset($plata))
        {
            if ($plata < 0)
                exit("Plata ne može biti negativna!");

            $sqlQuery .= ", plata";
            $types .= "d";
            $values .= ", ?";
            $parameters[] = $plata;
        }

        if (isset($godisnji))
        {
            if ($godisnji < 0)
                exit("Godišnji odmor ne može biti negativan!");

            $sqlQuery .= ", godisnji";
            $types .= "i";
            $values .= ", ?";
            $parameters[] = $godisnji;
        }
        // end optional

        $sqlQuery .= ", pumpa)" . $values . ", ?);";
        $types .= "s";
        $parameters[] = $pumpa;

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
        {
            mysqli_stmt_close($statement);
            exit("Greška, pokušajte ponovo.");
        }
        else
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
                exit("Radnik '$email' već postoji!");
            }
        }
    }