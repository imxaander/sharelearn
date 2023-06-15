<?php
    include "connection.php";
    include "functions.php";

    if (isset($_POST["code"])) { 
        echo $_POST["code"];
    }else{
        echo "hi";
    }