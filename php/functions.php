<?php
include "connection.php";

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function addLog($type, $details, $timestamp){
    global $con;
    $logId = "" .  strtoupper(generateRandomString(5));
    $sql = "INSERT INTO logs VALUES('$logId','$type', '$details', '$timestamp')";
    $result = mysqli_query($con, $sql);

    if($result){
        echo "nice";
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

?>