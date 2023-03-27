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

                $file = '../uploads/' . $row["file_name"];

                if (file_exists($file)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.substr(basename($file), 15).'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);

                    $type = "Download";
                    $details = "$file_code";
                    $timestamp = time();
                    $duration = measure_download_speed($file);

                    $user_id = "";
                    $guest_id ="";
                    //user variables
                    if (isset($_SESSION["loggedIn"])) {
                        $user_id = $_SESSION["user_id"];
                    }else{
                        $guest_id = $_COOKIE["guest_id"];
                    }
                    addLog($type, $details, $timestamp, $duration, $user_id, $guest_id);
                    exit();
                }else{
                    echo "file not exists in the drive.";
                }
            }else{
                echo "file expired";
            }
        }else{
            echo "THERE IS NO result E ";
            echo $sql;
        }
    }else{
        echo "no code";
    }
?>