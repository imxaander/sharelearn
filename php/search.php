<?php
    #connection to database
    include 'connection.php';
    include 'functions.php';

    if (isset($_POST["file_code"])) {
        $file_code = $_POST["file_code"];
        
        #check if the file with the file code exists
        $sql = "SELECT * FROM files WHERE file_code = '$file_code'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){?>

        <?
        }else{ 
            echo "No file associated with code.";
        }
    }else{
        echo "No code entered.";
        echo $_POST["file_code"];
    }
?>
