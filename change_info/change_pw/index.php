<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="pwChange.js"></script>

    <link href="../../styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Promjena lozinke</title>
</head>
<body>

    <h1> PeroPetrol - Promjena lozinke </h1>

    <form action="change_pw.php" method="POST">
        <?php
            if (!isset($_SESSION['role']))
                echo '<p><input type="email" placeholder="Trenutni mejl" name="currentEmail" required></p>';
        ?>
        <p><input type="password" placeholder="Trenutna lozinka" name="currentPW" required></p>
        <p><input type="password" minlength="8" placeholder="Nova lozinka" name="newPW" required></p>
        <p><input type="password" placeholder="Ponovite novu lozinku" name="newPW_repeat" required></p>
        <p><input class="form_button" type="submit" value="Promijeni lozinku"></p>
    </form>
    
    <p class="pwChangeInfoMsg"></p>

</body>
</html>