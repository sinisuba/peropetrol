<?php
session_start();

if ($_SESSION['role'] !== "admin")
    header("Location: https://localhost/peropetrol/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="radnikNew.js"></script>

    <link href="../../styles.css" rel="stylesheet">
    
    <style>
        input {
            width: 15vw;
        }

        input[type="submit"] {
            width: inherit;
        }
    </style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Novi radnik</title>
</head>
<body>

    <h1> PeroPetrol - Registrovanje novog radnika </h1>

    <i> Polja označena sa * moraju biti popunjena! </i>

    <form action="novi_radnik.php" method="POST">
        <p><input type="text" placeholder="* Ime" name="firstname" required></p>
        <p><input type="text" placeholder="* Prezime" name="lastname" required></p>
        <p><input type="email" placeholder="* Email" name="email" required></p>
        <p><input type="password" minlength="8" placeholder="* Lozinka" name="password" required></p>
        <p><input type="password" placeholder="* Ponovite lozinku" name="password_repeat" required></p>
        <p><input type="number" min="0" placeholder="Staž (godine, default: 0)" name="staz"></p>
        <p><input type="number" min="0" step="0.01" placeholder="Plata (default: 500KM)" name="plata"></p>
        <p><input type="number" min="0" placeholder="Godišnji odmor (dani, default: 0)" name="godisnji"></p>
        <input list="pumpe" placeholder="* Lokacija pumpe" name="pumpa" pattern="Obilićevo|Starčevica|Petrićevac" required>
        <datalist id="pumpe">
            <option value="Obilićevo">
            <option value="Starčevica">
            <option value="Petrićevac">
        </datalist>
        <p><input class="form_button" type="submit" value="Dodaj radnika"></p>
    </form>

    <p class="radnikNewInfoMsg"></p>

</body>
</html>