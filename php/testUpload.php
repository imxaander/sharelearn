<?php
    session_start();
    include "connection.php";
    include "functions.php";
if(isset($_FILES['file'])){

    $errors= array();
    $target_dir = "../uploads/";

    // loop through all the uploaded files
    foreach($_FILES['file']['name'] as $key=>$name){
        //for database
        $code_count = 10;
        $file_code = strtoupper('PNHS' . generateRandomString($code_count));
        $file_expiration = "1 day";
        $file_security = "private";
        $uploaded_date = Date("Y-m-d H:i:s");

        //for addition of files
        $file_name = basename($_FILES['file']['name'][$key]);
        $target_file = $target_dir . $file_code . "_" .  $file_name;
        $file_size = $_FILES['file']['size'][$key];
        $file_tmp = $_FILES['file']['tmp_name'][$key];
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $file_name_local = $file_code . "_" .  $file_name;
        $user_id = "";
        $guest_id ="";
        //user variables
        if (isset($_SESSION["loggedIn"])) {
            $user_id = $_SESSION["user_id"];
        }else{
            $guest_id = $_COOKIE["guest_id"];
        }
        $device_id = $_COOKIE["device_id"];
        // check if file already exists
        if (file_exists($target_file)) {
            $errors[] = "File $file_name already exists.";
        }
        // check file size
        if ($file_size > 5000000) {
            $errors[] = "File $file_name is too large. Max file size is 5 MB.";
        }

        if(empty($errors)==true) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                $upload_speed = format_speed(measure_upload_speed($_FILES["file"]));
                
                $sql = "INSERT INTO files VALUES('', '$file_code', '$guest_id', '$user_id', '$file_name_local', '$file_expiration', '$file_security', '$uploaded_date', '$file_size', '$upload_speed')";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "File $file_name is uploaded successfully.";
                }
            }else{
                echo "not good";
            }
            
        } else {
            foreach ($errors as $error) {
                echo "$error";
            }
        }
    }

} else {
    echo "No file has been uploaded.";
}
?>