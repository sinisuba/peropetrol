<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol</title>
</head>
<body>

    <?php
        if (isset($_SESSION['role']))
        {
            echo "<h1> Dobrodošli na PeroPetrol. </h1> <h2> Prijavljeni ste kao '" . $_SESSION['email'] . "' </h2>";

            if ($_SESSION['role'] === "admin")
                echo '<a href="admin/" target="_blank"><button class="general_button">ADMIN PANEL</button></a>';
            else if ($_SESSION['role'] === "radnik")
                echo '<a href="radnici/" target="_blank"><button class="general_button">RADNICI</button></a>';
            else
            {
                echo
                '
                    <div class="items">
                        <a href="pumpe/lista.php" target="_blank"><button class="general_button">PUMPE</button></a>
                        <a href="change_info/" target="_blank"><button class="general_button">PROMJENA INFORMACIJA</button></a>
                    </div>
                ';
            }
    
            echo '<p> <a class="general_button" href="login/logout.php">Odjava</a> </p>';
        }
        else
        {
            echo "<h1> Dobrodošli na PeroPetrol. </h1>";

            if (isset($_GET["lo"]))
                if ($_GET["lo"] === "OK")
                    echo "<h3>Odjavili ste se.</h3>";

            echo
            '
                <div class="items">
                    <a class="general_button" href="login/">Login</a>
                    <a class="general_button" href="registracija/">Registracija</a>
                    <p> <a class="general_button" href="change_info/" target="_blank">Promjena informacija</a> </p>
                </div>
            ';
        }
    ?>

</body>
</html>