<?php
    require "../db/dbConn.php";

    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_repeat']) || empty($_POST['pumpa']))
        exit("Popunite sva polja!");
    else
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_repeat = $_POST['password_repeat'];
        $pumpa = $_POST['pumpa'];
    }

    if (strlen($password) < 8)
        echo "Lozinka mora sadržati minimalno 8 karaktera!";
    else if ($password !== $password_repeat)
        echo "Unesene lozinke se ne podudaraju!";
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        echo "Uneseni email '$email' nije validan!";
    else if (!in_array($pumpa, ["Obilićevo", "Starčevica", "Petrićevac", "Gost"]))
        echo "Odaberite jednu od ponuđenih pumpi!";
    else if ($pumpa === "Gost" && substr($email, -15)  === "@peropetrol.com")
        echo "Domen 'peropetrol.com' je rezervisan za zaposlene PeroPetrola. <br> Molimo Vas da odaberete drugu email adresu.";
    else if ($pumpa !== "Gost")
    {
        if (substr($email, -15) !== "@peropetrol.com")
            exit("Zaposleni PeroPetrola moraju koristiti domen 'peropetrol.com'");

        if (strpos($email, "admin") !== false)
            exit("Zabranjen mejl!");
    }
    else
    {
        if ($pumpa === "Gost")
            $sqlQuery = "INSERT INTO korisnici(ime, prezime, korisnik_email, korisnik_password) VALUES (?, ?, ?, ?);";
        else $sqlQuery = "INSERT INTO radnici(ime, prezime, radnik_email, radnik_password, pumpa) VALUES (?, ?, ?, ?, ?);";
        
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
        {
            mysqli_stmt_close($statement);
            exit("Greška, pokušajte ponovo.");
        }
        else
        {
            if ($pumpa === "Gost")
                mysqli_stmt_bind_param($statement, "ssss", $firstname, $lastname, $email, $hash);
            else mysqli_stmt_bind_param($statement, "sssss", $firstname, $lastname, $email, $hash, $pumpa);

            mysqli_stmt_execute($statement);

            if (mysqli_stmt_affected_rows($statement) > 0)
            {
                mysqli_stmt_close($statement);
                exit("OK");
            }
            else
            {
                mysqli_stmt_close($statement);
                exit("Korisnik '$email' već postoji. <br> > <a href='../login'>Login</a>");
            }
        }
    }