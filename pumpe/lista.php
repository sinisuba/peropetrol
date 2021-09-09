<?php
session_start();

if (!isset($_SESSION['role']))
{
    $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

    exit("<h3> Nemate pristup ovoj stranici. </h3> <p> Molimo Vas da se <a href='$redirect/login/'>prijavite</a>. </p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
            <tr id="tablePumpeHeader">
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
                            if ($i === 0) // ID column
                                echo "<td>" . $currentRow[$i] . "</td>";
                            else if ($i === 1) // location column
                            {
                                echo "<td class='currentRowLocation'>" . $currentRow[$i] . "</td>";
                                $currentLocation = $currentRow[$i];
                            }
                            else // fuel columns
                            {
                                if ($_SESSION['role'] === "admin")
                                    echo "<td contenteditable>" . $currentRow[$i] . "</td>"; // allow edits from within the table
                                else if ($_SESSION['role'] === "radnik")
                                {
                                    require_once "get_radnik_location.php";

                                    if ($currentLocation === $radnikLocation)
                                        echo "<td contenteditable>" . $currentRow[$i] . "</td>";
                                    else echo "<td>" . $currentRow[$i] . "</td>";
                                }
                                else echo "<td>" . $currentRow[$i] . "</td>";
                            }
                        }

                        // 'count($currentRow) > 2' checks if any fuel columns exist before implementing the edit fuel button
                        if ($_SESSION['role'] === "admin" && count($currentRow) > 2)
                            echo "<td><button class='form_button modalButtonIzmjenaGorivo'>IZMIJENI</button></td>";
                        else if ($_SESSION['role'] === "radnik" && count($currentRow) > 2)
                        {
                            require_once "get_radnik_location.php";

                            if ($currentLocation === $radnikLocation)
                                echo "<td><button class='form_button modalButtonIzmjenaGorivo'>IZMIJENI</button></td>";
                        }

                        echo "</tr>";
                    }
                ?>
            </tr>
        </tbody>
    </table>

    <p id="editFuelInfoMsg"></p>

    <?php
        if ($_SESSION['role'] === "admin" || $_SESSION['role'] === "radnik")
            echo "<p><button class='form_button' id='modalButtonAdd'>Dodaj novo gorivo</button></p>";

        if ($_SESSION['role'] === "admin")
            echo "<p><button class='form_button' id='modalButtonDelete'>Briši gorivo</button></p>";
    ?>

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