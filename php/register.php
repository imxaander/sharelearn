<?php
    include "connection.php";
    include "functions.php";
    date_default_timezone_set('Asia/Manila');
    //check if there's username
    if (isset($_POST["username"])) {
        //initiate passed variables from register
       $username = $_POST["username"];
       $email = $_POST["email"];
       $password = $_POST["password"];
       $role = $_POST["role"];
       $device_id = $_POST["device_id"];
       $date_created = time();

        //check if there's existing email
        $sql = "SELECT * FROM users WHERE email = '$email' OR device_id = '$device_id'";
        $result = mysqli_query($con, $sql);

        //if there;'s no existing
        if (mysqli_num_rows($result) == 0) {
            $user_id = "USER". generateRandomString(6);
            $sql = "INSERT INTO users VALUES('$user_id', '$username', '$email', '$password', '$role', '$device_id', '$date_created')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                alert("success", "Register success! Please login .");
                header("Location: /access.php");
            }else{
                alert("danger", "Something wrong in adding your account to database. in: ". $sql);
                header("Location: /access.php");
            }
        }else{
            alert("danger", "There must be an existing account for this device. or Email exist already.");
            header("Location: /access.php");
        }
    }else {
        redirectToHome();
    }
