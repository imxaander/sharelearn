<?php
    #connection to database
    include 'connection.php';
    include 'functions.php';

    if (isset($_POST["file-code"])) {
        $file_code = $_POST["file-code"];
        
        #check if the file with the file code exists
        $sql = "SELECT * FROM files WHERE file_code = '$file_code'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            header("Location:  ../?search=".$file_code);
        }else{?>
<html>
    <head>
        <script>
            window.history.back();
        </script>
    </head>
</html>
        <?php
            
        }
    }else{
        header("Location:  ../");
    }
?>
