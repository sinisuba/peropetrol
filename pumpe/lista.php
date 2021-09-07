<?php
session_start();

if (!isset($_SESSION['role']))
    exit("<h3> Nemate pristup ovoj stranici. </h3> <p> Molimo Vas da se <a href='https://localhost/peropetrol/login/'>prijavite</a>. </p>");    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="gorivoEdit.js"></script>
    <script src="gorivoDelete.js"></script>
    <script src="gorivoNew.js"></script>

    <style>
    table.blueTable {
        width: 33% !important;
    }
    </style>
    
    <link href="../styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Pumpe</title>
</head>
<body>

    <h1>PeroPetrol - Pumpe</h1>

    <table class="blueTable">
        <thead>
            <tr>
                <?php
                    require_once "../db/dbConn.php";

                    $sqlQuery = "SHOW COLUMNS FROM pumpe;";

                    $queryResult = mysqli_query($conn, $sqlQuery);

                    while ($currentRow = mysqli_fetch_assoc($queryResult))
                        echo "<th>" . current($currentRow) . "</th>";
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                    require_once "../db/dbConn.php";

                    $sqlQuery = 'SELECT * FROM pumpe;';

                    $queryResult = mysqli_query($conn, $sqlQuery);

                    while ($currentRow = mysqli_fetch_array($queryResult, MYSQLI_NUM))
                    {
                        echo "<tr>";

                        $currentLocation = "";
                        
                        for ($i = 0; $i < count($currentRow); ++$i)
                        {
                            if ($i === 1) // current location
                            {
                                echo "<td class='currentRowLocation'>" . $currentRow[$i] . "</td>";
                                $currentLocation = $currentRow[$i];
                            }
                            else echo "<td>" . $currentRow[$i] . "</td>";
                        }

                        if ($_SESSION['role'] === "admin")
                            echo "<td><button class='form_button modalButtonIzmjenaGorivo'>IZMIJENI</button></td>";
                        else if ($_SESSION['role'] === "radnik")
                        {
                            include "get_radnik_location.php";

                            if ($currentLocation === $radnikLocation)
                                echo "<td><button class='form_button modalButtonIzmjenaGorivo'>IZMIJENI</button></td>";
                        }

                        echo "</tr>";
                    }
                ?>
            </tr>
        </tbody>
    </table>

    <?php
        if ($_SESSION['role'] === "admin" || $_SESSION['role'] === "radnik")
            echo "<p><button class='form_button' id='modalButtonAdd'>Dodaj novo gorivo</button></p>";
            
        if ($_SESSION['role'] === "admin")
            echo "<p><button class='form_button' id='modalButtonDelete'>Briši gorivo</button></p>";
    ?>

    <div id="editGorivoModal" class="modal">
        <div class="modal-content">
            <button class="closeModal" id="editGorivoModalClose">&times;</button>

            <h2> PeroPetrol - Izmjena količine goriva </h2>
            <form action="izmjena_gorivo.php" method="POST" id="form_EditGorivo">
                <p>
                <input type="text" placeholder="Naziv goriva" name="gorivo_naziv" required>
                </p>
                <p><input type="number" min="0" placeholder="Nova količina goriva (l)" name="gorivo_kolicina" required></p>
                <p><input class="form_button" type="submit" value="Izmjeni gorivo"></p>
            </form>

            <p id="editGorivoModalInfoMsg"></p>
        </div>
    </div>

    <div id="deleteGorivoModal" class="modal">
        <div class="modal-content">
            <button class="closeModal" id="deleteGorivoModalClose">&times;</button>

            <h2> PeroPetrol - Brisanje goriva </h2>
            <form action="brisi_gorivo.php" method="POST" id="form_DeleteGorivo">
                <p><input type="text" placeholder="Naziv goriva" name="gorivo_naziv" required></p>
                <p><input class="form_button" type="submit" value="Izbriši gorivo"></p>
            </form>

            <p id="deleteGorivoModalErrMsg"></p>
        </div>
    </div>

    <div id="addGorivoModal" class="modal">
        <div class="modal-content">
            <button class="closeModal" id="addGorivoModalClose">&times;</button>

            <h2> PeroPetrol - Novo gorivo </h2>

            <form action="novo_gorivo.php" method="POST" id="form_AddGorivo">
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

            <p id="addGorivoModalErrMsg"></p>
        </div>
    </div>

</body>
</html>