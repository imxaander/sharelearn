<?php
include "connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Manila');
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function addLog($type, $details, $timestamp, $duration, $user, $guest){
    global $con;
    $logId = "LOG" .  strtoupper(generateRandomString(5));
    $sql = "INSERT INTO logs VALUES('$logId','$type', '$details', '$timestamp', '$duration', '$user', '$guest')";
    $result = mysqli_query($con, $sql);

    if($result){
        
    }
}

function measure_download_speed($file_url)
{
    // Get the start time in seconds with microseconds
    $start_time = microtime(true);
    
    // Send HTTP headers to force download
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
    readfile($file_url); // Download the file

    // Get the end time in seconds with microseconds
    $end_time = microtime(true);
    
    // Calculate the download time and file size
    $download_time = $end_time - $start_time;
    $file_size = filesize($file_url);

    // Calculate the download speed in bytes per second
    $download_speed = $file_size / $download_time;

    // Convert the speed to kilobytes or megabytes per second as appropriate
    if ($download_speed < 1024) {
        return round($download_speed, 2) . " B/s";
    } elseif ($download_speed < 1048576) {
        return round($download_speed / 1024, 2) . " KB/s";
    } else {
        return round($download_speed / 1048576, 2) . " MB/s";
    }
}

function measure_upload_speed($file_error, $file_name, $file_tmp, $file_size) {
    $start_time = microtime(true);

    if ($file_error === UPLOAD_ERR_OK) {
        $target_file = "../temp/tmp" . basename($file_name);
        file_put_contents($target_file, file_get_contents($file_tmp));
        
    } else {
        return false;
    }
    unlink($target_file);
    $end_time = microtime(true);
    $elapsed_time = $end_time - $start_time;
    $upload_speed = $file_size / $elapsed_time;

    return $upload_speed;
}
function format_speed($speed) {
    if ($speed < 1024) {
        return $speed . ' B';
    } else if ($speed < 1048576) {
        return round($speed / 1024, 2) . ' KB/s';
    } else if ($speed < 1073741824) {
        return round($speed / 1048576, 2) . ' MB/s';
    } else {
        return round($speed / 1073741824, 2) . ' GB/s';
    }
}
function displayLogs(){
    global $con;
    if(isset($type)){
        $sql = "SELECT * FROM logs WHERE '$type'='$arg' ORDER BY timestamp DESC";
    }else{
        $sql = "SELECT * FROM logs ORDER BY timestamp DESC";
    }

    $result = mysqli_query($con, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            $timestamp = $row["timestamp"];
            $date_format = 'M d, Y \a\t h:i A';
            $date_string = date($date_format, $timestamp);

            $action = strtolower($row["type"]);

            $message = "none";
            ?>
            <div class="logs-wrapper <?php echo $action?>-log">
                <?php
                if ($action == "upload") {
                    $message = "has uploaded";
                    echo '<div class="logs-icon-upload"><i class="fa-solid fa-upload"></i></div>';
                }else if ($action == "download") {
                    $message = "has downloaded";
                    echo '<div class="logs-icon-download"><i class="fa-solid fa-download"></i></div>';
                }
                ?>
                
                    <div class="logs-container">
                        <div class="log">
                                <p><b>  <?php echo $row["user_id"] . $row["guest_id"]?></b> <?php echo $message?>  <b> <?php echo $row["details"]?></b> </p>
                                <p class="log-date"><?php echo $date_string?> - <?php echo $row["duration"]?></p>
                        </div>
                    </div>
                </div>
        <?php
        }
    }
}
function redirectToHome(){
    header("Location: ../");
}
function alert($type, $message){
    session_start();

    $_SESSION["alert"] = 1;
    $_SESSION["alert_message"] = $message;
    $_SESSION["alert_type"] = $type;
}
function displayAlerts(){
    if (isset($_SESSION["alert"])) {
        $message = $_SESSION["alert_message"];
        $type = $_SESSION["alert_type"];

        echo '<div class="alert alert-'.$type.'" role="alert">'.$message.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <br>
        </div>';

        unset($_SESSION["alert"]);
        unset($_SESSION["alert_message"]);
        unset($_SESSION["alert_type"]);
    }
}

function getIconForUpload($fileformat){

    switch ($fileformat) {
        case "mp3":
        case "ogg":
        case "wav":
            return "-audio";
            break;
        case "docx":
        case "doc":
            return "-word";
            break;
        case "ppt":
        case "pptx":
            return "-powerpoint";
            break;
        case "xlsx":
        case "xlsm":
        case "xlsb":
        case "xltm":
        case "xltm":
            return "-excel";
            break;
        case "gif":
        case "png":
        case "jpg":
        case "jpeg":
        case "jfif":
            return "-image";
            break;
        case "pdf":
            return "-pdf";
            break;
        default:
            return "";
            break;
    }
}

function greet(){
    date_default_timezone_set('Asia/Manila'); // Replace 'Your_Timezone' with your desired timezone

    $currentHour = date('H');

    if ($currentHour >= 5 && $currentHour < 12) {
        return "Good morning!";
    } elseif ($currentHour >= 12 && $currentHour < 18) {
        return "Good afternoon!";
    } elseif ($currentHour >= 18 || $currentHour < 5) {
        return "Good evening!";
    } else {
        return "Hello!";
    }
}
?>
