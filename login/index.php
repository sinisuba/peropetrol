<?php
session_start();

if (isset($_SESSION['role']))
{
    $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

    header("Location: $redirect");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Login</title>
</head>
<body>
    
    <h1> PeroPetrol - Login </h1>

    <form action="login.php" method="POST">
        <p><input type="email" placeholder="Email" name="email" required></p>
        <p><input type="password" placeholder="Lozinka" name="password" required></p>
        <p><input class="form_button" type="submit" value="Login" name="form_submit"></p>
    </form>

    <?php
        if (isset($_GET["login"]))
        {
            if ($_GET["login"] === "mysqlistmt")
                echo "<i> Greška, pokušajte ponovo. </i>";
            else if ($_GET["login"] === "PW")
                echo "<i> Pogrešna lozinka! </i>";
            else if ($_GET["login"] === "NR")
                echo "<i> Korisnik nije registrovan! </i> <br> > <b> <a href='../registracija'> Registracija </a> </b>";
        }
    ?>

    <h2> > <a href='../'> Nazad na početnu stranicu </a> </h2>

</body>
</html>