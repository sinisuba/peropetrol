<?php
session_start();

if ($_SESSION['role'] !== "admin")
    header("Location: https://localhost/peropetrol/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../styles.css" rel="stylesheet">
    <style>
        p {
            font-size: 20px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Admin Panel</title>
</head>
<body>

    <h1>PeroPetrol - Admin Panel</h1>

    <hr>
    <p>Radnici</p>
    <hr>
        <div class="items">
            <a href="lista_radnika.php" target="_blank" class="general_button">Lista radnika</a>
            <a href="novi_radnik/" target="_blank" class="general_button">Kreiraj novog radnika</a>
        </div>
    <hr>

    <p>Pumpe</p>
    <hr>
        <div class="items">
            <a href="../pumpe/lista.php" target="_blank" class="general_button">Lista pumpi (goriva)</a>
        </div>
    <hr>
    
</body>
</html>