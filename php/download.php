<?php
    #connection to database
    include 'connection.php';
    include 'functions.php';
    date_default_timezone_set('Asia/Manila');

    if (isset($_POST["file-code"])) {
        $file_code = $_POST["file-code"];
        $sql = "SELECT * FROM files WHERE file_code='$file_code'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $today = date("Y-m-d H:i:s");
            $expiration_date = strtotime($row["file_expiration"]);

            if ($expiration_date < $today) {

                $file = '../uploads/'.$row["file_name"];

                if (file_exists($file)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.substr(basename($file), 10).'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                    exit();
                }
            }else{
                header("Location: ../?error=File Expired");
            }
        }else{
            echo "THERE IS NO result E ";
        }
    }else{
        header("Location: ../");
    }
    echo $_POST["file-code"];
?>