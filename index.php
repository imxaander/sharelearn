<?php
    include "php/connection.php";
    include "php/functions.php";

    session_start();
    ?>
<html lang="">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="libs/css/bootstrap.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/fonts.css">
        <link rel="stylesheet" href="styles/animations.css">
        <link href="libs/fontawesome 6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="libs/toastify/toastify.css">
        <script defer src="libs/fontawesome 6/js/all.js"></script>
        <script src="scripts/index.js" defer></script>
        <script src="scripts/search.js" defer></script>
        <script src="libs/chartjs/dist/chart.umd.js"></script>
        <script src="libs/toastify/toastify.js"></script>

        <title>ShareLearn - Paranaque National Highschool - Main</title>
    </head>
    <body>

        <?php
        if (isset($_COOKIE["device_id"])) {
            $device_id = $_COOKIE["device_id"];
            
            displayAlerts();

        ?>
            <!-- Dim Panel -->

        <!-- Top Bar
        <div id="top-bar">
            <p id="top-text-header" onclick="colOrex()">PARAÑAQUE NATIONAL HIGH SCHOOL - MAIN - Home of the Gentle Warriors</p>
        </div>
        -->

        <!-- Top Navigation Bar -->
        <div id="top-nav-bar">
            <a class="fas fa-bars top-bar-buttons" aria-hidden="true" id="open-side-bar-button" onclick="openSideBar()"><i class="fa-solid fa-ellipsis-vertical"></i></a>
            <p id="tab-title">Home</p>
            <a  class="fa-solid fa-circle-info top-bar-buttons"><i class="fa-solid fa-circle-info"></i></a>
        </div>
       <!-- Side Navigation Bar  -->
    <div id="side-nav-bar">
            <i id="close-side-bar-button" onclick="closeSideBar()" class="fa fa-close"></i>
            <br><br>
            <a href=""></a>
            <br><br><br><br><br><br>
            <?php 
            if($_SESSION["loggedIn"] != "true"){?>
                <a href="/access.php">Login</a>
                <p>Have an account?</p>
                <a href="">Register</a>
                <p>Don't have an account yet?</p>
                <a href="#" onclick="removeCookies()">Remove Cookies</a>
            <?php   
            }else{
            ?>
                <a href="/php/logout.php">Logout</a>
                <p>Exit your account</p>
            <?php
            }
            ?>

        </div>

        <!-- Bottom Navigation Bar -->
        <div id="bottom-nav-bar">
            <a href="#" onclick="openTab(event, 'Home')" class="tablinks tab-selected"><i class="fa-solid fa-house"></i><p>Home</p></a>
            <a href="#" onclick="openTab(event, 'Upload')" class="tablinks"><i class="fa-solid fa-upload"></i><p>Upload</p></a>
            <a href="#" onclick="openTab(event, 'Download')" class="tablinks"><i class="fa-solid fa-download"></i><p>Download</p></a>
            <a href="#" onclick="openTab(event, 'Files')" class="tablinks"><i class="fa-solid fa-file"></i><p>Files</p></a>
                <!-- terms and conditions
            <a href="#" onclick="closeSideBar(); openTab(event, 'Terms-and-Conditions')" class="tablinks">Terms and Conditions</a>
            -->
        </div>

        <div id="Home" class="tabs">
            <p id="welcome-text-home">Hey, <b><?php echo  (isset($_SESSION["loggedIn"])) ?  $_SESSION["username"] : "Guest"; ?> </b></p>
            <p class="tabs-headers">Good Morning</p>
            <div id="storage-use-overview">
            </div>
        </div>

        <div id="Upload" class="tabs">
            <div id="upload-container">
                <div id="upload-wrapper">
                    <div id="fileList"></div>
                </div>
                <div id="upload-footer">
                    <label for="fileInput" id="add-items-button">
                            <input type="file" id="fileInput" name="file[]">
                            <i class="fa-solid fa-plus"></i>
                    </label>
                    <button id="uploadBtn"><i class="fa-solid fa-share-from-square"></i></i></button>
                </div>
            </div>
        </div>

        <div id="Download" class="tabs">
            <div id="download-container">
                <div id="download-wrapper">
                    <input type="text" placeholder="Enter File Code.." id="file-code-search-input" class="form-control" maxlength="14">
                </div>
                
                <p class="full-width-button" onclick="searchFile()"><i class="fas fa-search"></i></p>

                <div id="download-footer"></div>
            </div>
        </div>

        <div id="Files" class="tabs">
            <p class="tabs-headers">Files</p>

        </div>
        
        <?php
        }else{?>
        <div class="white-background">
            <h1><b>ShareLearn</b></h1>
            <i>
            <p><b>Share</b> your files right away,</p>
            <p><b>Learn</b> from it right away.</p>
        </i>
        <i class="fa-solid fa-circle-notch fa-spin"></i>

        </div>
        <div class="role-selection" id="student-selection" onclick="selectRole('student')">
            <br>
            <i class="fa-solid fa-graduation-cap role-selection-icons" id="student-selection-icon"></i>
            <p id="student-selection-text">STUDENT</p>
        </div>
        <div class="role-selection" id="teacher-selection" onclick="selectRole('teacher')">
            <br>
            <i class="fa-solid fa-chalkboard-user role-selection-icons"id="teacher-selection-icon" ></i>
            <p id="teacher-selection-text">TEACHER</p>
        </div>
        <form action="php/guestCreate.php" method="POST" id="guestForm" style="display: none">
            <input type="text" name="role" id="role-input">
        </form>
        <?php
        }
        ?>
        <script src="scripts/upload.js"></script>
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/popper.min.js" crossorigin="anonymous"></script>
        <script src="libs/js/bootstrap.min.js"></script>
    </body>
</html>

<!-- 
     Side Navigation Bar 
    <div id="side-nav-bar">
            <i id="close-side-bar-button" onclick="closeSideBar()" class="fa fa-close"></i>
            <br><br>
            <a href="#" onclick="closeSideBar(); openTab(event, 'Home')" class="tablinks tab-selected">Home</a>
            <a href="#" onclick="closeSideBar(); openTab(event, 'MyUploads')" class="tablinks">My Uploads</a>
            <a href="#" onclick="closeSideBar(); openTab(event, 'About')" class="tablinks">About Sharelearn</a>
            <a href="#" onclick="closeSideBar(); openTab(event, 'Terms-and-Conditions')" class="tablinks">Terms and Conditions</a>
            <br><br><br><br><br><br>
            <a href="">Change User</a>
            <p>Current : Student</p>
            <a href="">Login</a>
            <p>For Researchers Only!</p>
        </div>
-->