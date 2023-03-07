<?php

    include "connection.php";
    include "functions.php";

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email = '$email' AND password ='$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            //there's an account
            while ($row = mysqli_fetch_array($result)) {
                session_start();
                $_SESSION["loggedIn"] = "true";
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["password"] = $row["password"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["device_id"] = $row["device_id"];
                $_SESSION["date_created"] = $row["date_created"];
                redirectToHome();
            }
        }else{
            alert("danger", "There's no account with this credentials.");
            header("Location: /access.php");
        }
    }else{
        redirectToHome();
    }