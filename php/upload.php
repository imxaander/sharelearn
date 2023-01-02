<?php
    #connection to database
    include 'connection.php';
    include 'functions.php';
    date_default_timezone_set('Asia/Manila');
    $code_count = 5;
    $code_start = -1;

    if(isset($_POST["submit"])) {
        #file upload
        if (isset($_POST["guest-id"])) {
            $guest_id = $_POST["guest-id"];
        }else{
            $guest_id = strtoupper('GUEST' . generateRandomString($code_count));
        }
        #get values
        $file_code = strtoupper('PNHS' . generateRandomString($code_count));
        $file_expiration = "1 day";
        $file_security = "";
        $uploaded_date = Date("Y-m-d H:i:s");
        
        $targetDirectory = "../uploads/";
        $targetFile = $targetDirectory . $file_code . "_" .  basename($_FILES["file"]["name"]);
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $maxFileSize = 104857600; #in bytes
        #check if file is actual image 

        $fileSize = filesize($_FILES["file"]["tmp_name"]);

        if($fileSize <  $maxFileSize) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                //check if there's already this uhhh mac address on the database
                $guest_device_id= $_POST["device-id"];

                $sql = "SELECT * FROM `guest` WHERE `device_id`='$guest_device_id'";
                $result = mysqli_query($con,$sql);

                if(!mysqli_num_rows($result) > 0){
                    //if there's no record, add an account
                    
                    $guest_type = $_POST["user-type"];
                    $date_joined = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO guest VALUES('$guest_id', '$guest_type', '$guest_device_id', '$date_joined', '' )";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        
                    }

                }else{
                    echo "There's already an account";
                }

                $file_name = $file_code . "_" .  basename($_FILES["file"]["name"]);
                $date_expiration = date('Y-m-d H:i:s', strtotime($uploaded_date .' + '. $file_expiration));
                $file_security = 'private';
                    
                $sql = "INSERT INTO files VALUES('', '$file_code', '$guest_id', '$file_name', '$date_expiration', 'private', '$uploaded_date')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    header("Location: ../?uploaded=".$file_code);
                }

            }else{
                echo "Sorry, there was an error uploading your file.";
            }
        $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
    }else{
        header('Location: ../');
    }

?>