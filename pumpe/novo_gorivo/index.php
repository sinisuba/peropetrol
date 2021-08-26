<?php
session_start();

if ($_SESSION['role'] !== "admin" && $_SESSION['role'] !== "radnik")
    header("Location: https://localhost/peropetrol/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="gorivoNew.js"></script>

    <link href="../../styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Gorivo</title>
</head>
<body>

    <h1> PeroPetrol - Novo gorivo </h1>

    <form action="novo_gorivo.php" method="POST">
        <?php
            if ($_SESSION['role'] === "admin")
            {
                echo
                '
                    <p>
                    <input list="pumpe" placeholder="Lokacija pumpe" name="lokacija" pattern="Obilićevo|Starčevica|Petrićevac" required>
                    <datalist id="pumpe">
                        <option value="Obilićevo">
                        <option value="Starčevica">
                        <option value="Petrićevac">
                    </datalist>
                    </p>
                ';
            }
        ?>
        <p><input type="text" placeholder="Naziv goriva" name="gorivo_naziv" required></p>
        <p><input type="number" min="0" placeholder="Količina goriva (l)" name="gorivo_kolicina" required></p>
        <p><input class="form_button" type="submit" value="Dodaj gorivo"></p>
    </form>

    <p class="newGorivoInfoMsg"></p>

</body>
</html>