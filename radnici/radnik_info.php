<link rel="stylesheet" href="../styles.css" type="text/css">
<?php
    session_start();

    if ($_SESSION['role'] !== "radnik")
        header("Location: https://localhost/peropetrol/");
    else
    {
        require "../db/dbConn.php";

        $email = $_SESSION['email'];

        $sqlQuery = 'SELECT staz, plata, godisnji FROM radnici WHERE radnik_email=?;';
        
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
        {
            mysqli_stmt_close($statement);
            exit("Greška, pokušajte ponovo.");
        }
        else
        {
            mysqli_stmt_bind_param($statement, "s", $email);

            mysqli_stmt_execute($statement);

            $queryResult = mysqli_stmt_get_result($statement);

            $currentRow = mysqli_fetch_assoc($queryResult);

            echo "<h2> Info o radniku: '" . $email . "' </h2>";

            echo
            '
                <table class="blueTable">
                    <thead>
                        <tr>
                            <th>Staž</th>
                            <th>Plata</th>
                            <th>Godišnji odmor</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                    <td>' . $currentRow["staz"] . ' god.</td>
                    <td>' . $currentRow["plata"] . 'KM</td>
                    <td>' . $currentRow["godisnji"] . ' dana</td>
                        </tr>
                    </tbody>
                </table>
            ';
        }

        mysqli_stmt_close($statement);
    }