<?php
session_start();

$redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

if (!isset($_SESSION['role']))
    exit("<h3> Nemate pristup ovoj stranici. </h3> <p> Molimo Vas da se <a href='$redirect/login/'>prijavite</a>. </p>");
else if ($_SESSION['role'] !== "radnik")
    header("Location: $redirect");
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
    <title>PeroPetrol - Radnici</title>
</head>
<body>

    <h1>PeroPetrol - Radnici</h1>
    <hr>
    
    <p>Informacije o radniku</p>
    <hr>
    <div class="items">
            <a href="radnik_info.php" target="_blank" class="general_button">Info o radniku '<?php echo $_SESSION['email'] ?>'</a>
    </div>
    <hr>

    <p>Promjena informacija</p>
    <hr>
        <div class="items">
            <a href="../change_info/change_email/" target="_blank" class="general_button">Promjena mejla</a>
            <a href="../change_info/change_pw/" target="_blank" class="general_button">Promjena lozinke</a>
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