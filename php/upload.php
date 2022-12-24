<?php
    #connection to database
    include 'connection.php';
    date_default_timezone_set('Asia/Manila');
    if(isset($_POST["submit"])) {
        #file upload

        #get values
        $file_code = uniqid('PNHS',6);
        $file_name = "";
        $file_expiration = "1 day";
        $file_security = "";
        $uploaded_date = Date("Y/m/d") ;
        
        $guest_device_id= $_POST["device-id"];
        $guest_id = strtoupper(uniqid('',6)) ;
        $guest_type = $_POST["user-type"];
        $date_joined = date("Y-m-d H:i:s");

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
                $sql = "SELECT * FROM `guest` WHERE `device_id`='$guest_device_id'";
                $result = mysqli_query($con,$sql);

                if(!mysqli_num_rows($result) > 0){
                    //if there's no record, add an account
                    $sql = "INSERT INTO guest VALUES('$guest_id', '$guest_type', '$guest_device_id', '$date_joined' )";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        //if successfull add
                        echo "Done add";
                    }
                }else{
                    echo "There's already an account";
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
        header('Location: ../index.php');
    }

?>