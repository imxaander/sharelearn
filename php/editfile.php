<?php
    include "connection.php";
    include "functions.php";

    if (isset($_POST["submit"])) {
        if ($_POST["submit"] == "save") {
            $name = $_POST["name"];
            $code = $_POST["code"];
            $security = $_POST["security"];
            $expiration = $_POST["expiration"];
            $oldname = $_POST["oldname"];

            $fname = $code . "_" . $name;

            

            if(rename("../uploads/" . $oldname , "../uploads/" . $fname )){
                $sql = "UPDATE files SET file_name = '$fname', file_security = '$security', file_expiration = '$expiration' WHERE file_code = '$code'";
                $result = mysqli_query($con, $sql);
                alert("success", "File details changed successfully.");
                redirectToHome();
            }	
        }elseif ($_POST["submit"] == "delete") {
            $name = $_POST["name"];
            $code = $_POST["code"];
            $security = $_POST["security"];
            $expiration = $_POST["expiration"];
            $oldname = $_POST["oldname"];

            $fname = $code . "_" . $name;
            
            $sql = "DELETE FROM Files WHERE file_code ='$code'";

            if (unlink("../uploads/" . $oldname)) {
                $result = mysqli_query($con, $sql);
                alert("success", "File has been deleted.");
                redirectToHome();
            }
        }
    }