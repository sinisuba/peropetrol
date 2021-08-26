<?php
session_start();

if (isset($_SESSION['role']))
    header("Location: https://localhost/peropetrol/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="registracija.js"></script>

    <link href="../styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Registracija</title>
</head>
<body>
    
    <h1> PeroPetrol - Registracija </h1>

    <form action="registracija.php" method="POST">
        <p><input type="text" placeholder="Ime" name="firstname" required></p>
        <p><input type="text" placeholder="Prezime" name="lastname" required></p>
        <p><input type="email" placeholder="Email" name="email" required></p>
        <p><input type="password" minlength="8" placeholder="Lozinka" name="password" required></p>
        <p><input type="password" placeholder="Ponovite lozinku" name="password_repeat" required></p>

        <input list="pumpe" placeholder="Pumpa" name="pumpa" pattern="Obilićevo|Starčevica|Petrićevac|Gost" required>
        <datalist id="pumpe">
            <option value="Obilićevo">
            <option value="Starčevica">
            <option value="Petrićevac">
            <option value="Gost">
        </datalist>

        <p><input class="form_button" type="submit" value="Registracija"></p>
    </form>

    <p class="registracijaInfoMsg"></p>

    <h2> > <a href='../'> Nazad na početnu stranicu </a> </h2>

</body>
</html>
