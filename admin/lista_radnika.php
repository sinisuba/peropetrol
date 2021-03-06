<?php
session_start();

if ($_SESSION['role'] !== "admin")
{
    $redirect = "https://" . $_SERVER['HTTP_HOST'] . "/peropetrol/";

    header("Location: $redirect");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="radnikDelete.js"></script>
    <script src="radnikEdit.js"></script>

    <link href="../styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeroPetrol - Lista radnika</title>
</head>
<body>

<h1>PeroPetrol - Radnici</h1>

<table class="blueTable">
    <thead>
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Email</th>
        <th>Staž</th>
        <th>Plata</th>
        <th>Godišnji</th>
        <th>Pumpa</th>
    </tr>
    </thead>
    <tbody>
        <?php
        require "../db/dbConn.php";

        $sqlQuery = 'SELECT ime, prezime, radnik_email, staz, plata, godisnji, pumpa FROM radnici;';

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
            echo "<i> Greška, pokušajte ponovo. </i>";
        else
        {
            mysqli_stmt_execute($statement);

            $queryResult = mysqli_stmt_get_result($statement);

            while ($currentRow = mysqli_fetch_assoc($queryResult))
                echo "<tr> <td>" . $currentRow['ime'] . " </td> <td>" . $currentRow['prezime'] . "</td> <td class='currentRowEmail'>" . $currentRow['radnik_email'] . "</td> <td>" . $currentRow['staz'] . "</td> <td>" . $currentRow['plata'] . '' . "</td> <td>" . $currentRow['godisnji'] . "</td> <td>" . $currentRow['pumpa'] . "</td> <td class='center'><button class='form_button modalButtonBrisi'>BRIŠI</button></td> <td class='center'><button class='form_button modalButtonIzmjena'>IZMIJENI</button></td> </tr>";
        }

        mysqli_stmt_close($statement);
        ?>
    </tbody>
</table>

<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <button class="closeModal" id="deleteUserModalClose">&times;</button>
        <p id="confirmationText"></p>
        <button id="buttonDeleteYes" class="form_button">Da</button>
        <button id="buttonDeleteNo" class="form_button">Ne</button>

        <p id="confirmationModalErrMsg"></p>
    </div>
</div>

<div id="editUserModal" class="modal">
    <div class="modal-content">
        <button class="closeModal" id="editUserModalClose">&times;</button>

        <h2> PeroPetrol - Izmjena podataka </h2>

        <p id="selectedRadnik"></p>

        <form action="izmjena_radnik.php" method="POST" id="form_RadnikEdit">
            <p><input type="text" placeholder="Novo ime radnika" name="firstname" required></p>
            <p><input type="text" placeholder="Novo prezime radnika" name="lastname" required></p>
            <p><input type="email" placeholder="Novi email radnika" name="email" required></p>
            <p><input type="password" placeholder="Nova lozinka radnika" name="password"></p>
            <p><input type="number" min="0" placeholder="Novi staž" name="staz" required></p>
            <p><input type="number" min="0" step="0.01" placeholder="Nova plata" name="plata" required></p>
            <p><input type="number" min="0" placeholder="Novi godišnji odmor" name="godisnji" required></p>

            <input list="pumpe" placeholder="Nova pumpa radnika" name="pumpa" pattern="Obilićevo|Starčevica|Petrićevac">
            <datalist id="pumpe">
                <option value="Obilićevo">
                <option value="Starčevica">
                <option value="Petrićevac">
            </datalist>

            <p><input class="form_button" type="submit" value="Izmijeni radnika"></p>
        </form>

        <p id="editUserModalInfoMsg"></p>

    </div>
</div>

</body>
</html>