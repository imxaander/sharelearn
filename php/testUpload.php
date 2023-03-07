<?php
    include "connection.php";
    include "functions.php";
if(isset($_FILES['file'])){

    $errors= array();
    $target_dir = "../uploads/";

    // loop through all the uploaded files
    foreach($_FILES['file']['name'] as $key=>$name){
        $file_name = basename($_FILES['file']['name'][$key]);
        $target_file = $target_dir . $file_name;
        $file_size = $_FILES['file']['size'][$key];
        $file_tmp = $_FILES['file']['tmp_name'][$key];
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // check if file already exists
        if (file_exists($target_file)) {
            $errors[] = "File $file_name already exists.";
        }
        // check file size
        if ($file_size > 5000000) {
            $errors[] = "File $file_name is too large. Max file size is 5 MB.";
        }

        if(empty($errors)==true) {
            move_uploaded_file($file_tmp, $target_file);
            #get values
            $file_code = strtoupper('PNHS' . generateRandomString($code_count));
            $file_expiration = "1 day";
            $file_security = "";
            $uploaded_date = Date("Y-m-d H:i:s");
        } else {
            foreach ($errors as $error) {
                echo "$error<br>";
            }
        }
    }

} else {
    echo "No file has been uploaded.";
}
?>