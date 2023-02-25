<?php
include "connection.php";
include "functions.php";

if (isset($_POST["role"])){// if there's a role
    #set device_id cookie
    #make id for device randomly
    $uniqueIdGeneration = uniqid("SLUSER");
    #cookieExpiration  the first numbers are like 60 seconds is minute, multiplied by 60 is equal to an hour
    #multiplied again to 24, which is a day, and 366 which is year, so which means its 1 year expiration
    $cookieExpiration = time()+60*60*24*366;//1 year expiration (366)
    #sets the cookie
    setcookie("device_id",$uniqueIdGeneration, $cookieExpiration, "/");

    #initiate variables for guest creation
    $guest_id = strtoupper('GUEST' . generateRandomString(5));//random unique id with GUEST at the first, 5 characters
    $guest_role =$_POST["role"]; //role, we passed from index.php
    $device_id = $uniqueIdGeneration; // cookie that we set earler
    $date_created = date("Y-m-d H:i:s"); //date of creation, date now in this format ig?
    
    #create query for guest creation
    $sql = "INSERT INTO guests VALUES('$guest_id', '$guest_role', '$device_id', '$date_created')";//query for insertion
    $result = mysqli_query($con, $sql);

    #check insertion of guest is successful
    if ($result) {
        #if successful, then return to homepage with welcome.
        alert("success", "Welcome to ShareLearn!. You can now upload and download through this system.");//show an alert success that welcomes you to the system
        redirectToHome();
    }else{
        echo $sql;
    }

}else{
    #helper function, to redirect when just opened this php
    redirectToHome();
}