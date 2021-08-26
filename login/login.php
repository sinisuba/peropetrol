<?php
    session_start();

    if (!isset($_POST["form_submit"]))
        header("Location: index.php");
    else
    {
        require "../db/dbConn.php";

        $email = $_POST['email'];
        $password = $_POST['password'];

        $korisnik = "korisnik"; // default

        if ($email === "admin@peropetrol.com")
        {
            $korisnik = "admin";
            $sqlQuery = "SELECT admin_password FROM admin WHERE admin_email=?";
        }
        else if (str_ends_with($email, "@peropetrol.com"))
        {
            $korisnik = "radnik";
            $sqlQuery = "SELECT radnik_password FROM radnici WHERE radnik_email=?";
        }
        else $sqlQuery = "SELECT korisnik_password FROM korisnici WHERE korisnik_email=?";

        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sqlQuery))
            header("Location: index.php?login=mysqlistmt");
        else
        {
            mysqli_stmt_bind_param($statement, "s", $email);
            
            mysqli_stmt_execute($statement);

            $queryResult = mysqli_stmt_get_result($statement);

            $currentRow = mysqli_fetch_assoc($queryResult);

            if (mysqli_num_rows($queryResult))
            {
                if ($korisnik === "admin")
                    $hash = $currentRow['admin_password'];
                else if ($korisnik === "radnik")
                    $hash = $currentRow['radnik_password'];
                else
                    $hash = $currentRow['korisnik_password'];

                if (password_verify($password, $hash))
                {
                    if ($korisnik === "admin")
                        $_SESSION['role'] = "admin";     
                    else if ($korisnik === "radnik")
                        $_SESSION['role'] = "radnik";
                    else if ($korisnik === "korisnik")
                        $_SESSION['role'] = "korisnik";
                    
                    $_SESSION['email'] = $email;

                    header("Location: ../");
                }
                else header("Location: index.php?login=PW");
            }
            else header("Location: index.php?login=NR");
        }

        mysqli_stmt_close($statement);
    }