<?php
    #connection to database
    include 'connection.php';
    
    if(isset($_POST["submit"])) {
        #file upload

        #get values
        $file_code = uniqid('PNHS',6);
        $file_name = "";
        $file_expiration = "1 day";
        $file_security = "";
        $uploaded_date = Date("Y/m/d") ;

        $targetDirectory = "../uploads/";
        $targetFile = $targetDirectory . $file_code . "_" .  basename($_FILES["file"]["name"]);
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $maxFileSize = 104857600; #in bytes
        #check if file is actual image 

        $fileSize = filesize($_FILES["file"]["tmp_name"]);

        if($fileSize <  $maxFileSize) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                
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