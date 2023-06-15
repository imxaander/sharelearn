<?php
    include "php/connection.php";
    include "php/functions.php";

    session_start();
    if (isset($_SESSION["loggedIn"])) {
        $user_id = $_SESSION["user_id"];
        $username = $_SESSION["username"];
        $email = $_SESSION["email"];
        $role = $_SESSION["role"];
        $date_created = $_SESSION["date_created"];
    }
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
        <script src="libs/qrcodejs/qrcode.js"></script>
        <script src="libs/htmlscanner/html5-qrcode.min.js"></script>
        <title>ShareLearn - Paranaque National Highschool - Main</title>
    </head>
    <body>

        <?php
        if (isset($_COOKIE["device_id"])) {
            $device_id = $_COOKIE["device_id"];
            
            displayAlerts();

        ?>
            <!-- Dim Panel -->
            <div id="dim-pane" onclick="closeFromDim()"></div>
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
            if(isset($_SESSION["loggedIn"]) != "true"){?>
                <a href="/access.php">Login</a>
                <p>Have an account?</p>
                <a href="/access.php">Register</a>
                <p>Don't have an account yet?</p>
            <?php   
            }else{
            ?>
                <a href="/php/logout.php">Logout</a>
                <p>Exit your account</p>
            <?php
            }
            ?>
            <a href="#" onclick="openTab(event, 'About')" class="tablinks">About</a>
            <a href="#" onclick="openTab(event, 'TermsConditions')" class="tablinks">Terms and Conditions</a>
        </div>

        <!-- Bottom Navigation Bar -->
        <div id="bottom-nav-bar">
            <a href="#" onclick="openTab(event, 'Home')" class="tablinks tab-selected"><i class="fa-solid fa-house"></i><p>Home</p></a>
            <a href="#" onclick="openTab(event, 'Upload')" class="tablinks"><i class="fa-solid fa-upload"></i><p>Upload</p></a>
            <a href="#" onclick="openReader()"><i class="fa-solid fa-qrcode" id="open-qr"></i></a>
            <a href="#" onclick="openTab(event, 'Download')" class="tablinks"><i class="fa-solid fa-download"></i><p>Download</p></a>
            <a href="#" onclick="openTab(event, 'Files')" class="tablinks"><i class="fa-solid fa-file"></i><p>Files</p></a>
            
                <!-- terms and conditions
            <a href="#" onclick="closeSideBar(); openTab(event, 'Terms-and-Conditions')" class="tablinks">Terms and Conditions</a>
            -->
        </div>

        <div id="Home" class="tabs">
            <p id="welcome-text-home">Hey, <b><?php echo  (isset($_SESSION["loggedIn"])) ?  $_SESSION["username"] : "Guest"; ?> </b></p>
            <p class="tabs-headers"><?php echo greet() ?></p>
            <hr>
            <div>

            </div>
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
            <div id="file-list">
            <?php

            if (isset($_SESSION["loggedIn"]) != true) {
            ?>
            <p><a href="/access.php">Login</a> to edit, generate QR Code and more!</p>
            <?php
            # broadcast files
            $guest_id = $_COOKIE["guest_id"];
            $sql = "SELECT * FROM files WHERE guest_id = '$guest_id'";
            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)){?>
            <div class="uploaded-files">
                <i class="uploaded-file-icon fa-solid fa-file<?php echo getIconForUpload(pathinfo($row["file_name"], PATHINFO_EXTENSION))?>">
                </i>
                <p class="uploaded-file-name">
                    <?php echo substr($row["file_name"], 15)?>
                </p>
                
                <i class="fa-solid fa-copy uploaded-file-edit-icon" onclick='copyText("<?php echo $row["file_code"]?>")'></i>

            </div>
            <?php
            }
            ?>

            <?php
            }else{
                $sql = "SELECT * FROM files WHERE user_id = '$user_id'";
                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)){?>
                <div class="uploaded-files">
                    <i class="uploaded-file-icon fa-solid fa-file<?php echo getIconForUpload(pathinfo($row["file_name"], PATHINFO_EXTENSION))?>">
                    </i>
                    <p class="uploaded-file-name">
                        <?php echo substr($row["file_name"], 15)?>
                    </p>
                    
                    <i class="fa-solid fa-ellipsis-vertical uploaded-file-edit-icon" onclick='openEditWindow("<?php echo $row["file_code"]?>")'></i>
                </div>
                
                <div class="uploaded-file-edit" id="<?php echo $row["file_code"] ?>">
                    <i class="fa fa-close uploaded-file-edit-close-button" onclick='closeEditWindow("<?php echo $row["file_code"] ?>")'>
                    </i>
                    <br>
                    <p class="edit-file-name" name=""><b>Name: </b><input type="text" value="<?php echo $row["file_name"]?>"></p>
                    <p class="edit-file-id"><b>ID:</b> <?php echo $row["file_code"]?> <i class="fa-solid fa-copy edit-file-id-copy-icon" onclick="copyText('<?php echo $row['file_code']?>')"></i> </p>
                    <p><b>Security :</b>  
                        <select id="edit-file-security">
                            <option 
                                value="private" 
                                <?php if ($row["file_security"] == "private") {
                                    echo "selected";
                                }?>
                            >Private</option>
                            <option value="public"
                                <?php if ($row["file_security"] == "public") {
                                    echo "selected";
                                }?>
                            >Public</option>
                        </select>
                    </p>
                    <p><b>Availability :</b>  
                        <select id="edit-file-expiration">
                            <option 
                                value="available" 
                                <?php if ($row["file_expiration"] == "available") {
                                    echo "selected";
                                }?>
                            >Available</option>
                            <option value="unavailable"
                                <?php if ($row["file_security"] == "unavailable") {
                                    echo "selected";
                                }?>
                            >Unavailable</option>
                        </select>
                    </p>
                    <p><b>Uploaded:</b> <?php echo $row["uploaded_date"]?></p>
                    <p><b>Size:</b> <?php echo format_speed($row["file_size"]) ?></p>
                    
                    
                    <a class="" href="../?search=<?php echo $row['file_code']?>"><b>Download</b></a>
                    <p style="margin:0">or</p>
                    <a class="" href="#" id="generate<?php echo $row['file_code']?>" onclick="createQR('<?php echo $row['file_code']?>')"><b>Show QR code</b></a>
                    <div class="qrcodes" id="qrcode-<?php echo $row['file_code']?>"></div>
                    

                </div>
            <?php        
                }
            }
            ?>
            </div>
        </div>
        <div id="About" class="tabs">
            <h2 align="center" class="bold"><font color="#0B8043">ShareLearn</font></h2>
            <p class="bold">A Convenient and Collaborative File Sharing System for PNHS</p>

            <div id="about-desc">
                <p>ShareLearn is a file sharing system designed to help students and teachers at your school easily and efficiently share files with one another. With ShareLearn, users can upload and download files to a central location within the school's network, making it easy to access important course materials, assignments, and other resources.</p>
                <p>The system is named ShareLearn because it is intended to facilitate knowledge sharing and collaboration among students and teachers. By providing a centralized platform for file sharing, ShareLearn can help to reduce the time and effort required to manage and distribute course materials, and can help to foster a more collaborative learning environment.</p>
                <p>In addition to its file sharing capabilities, ShareLearn also includes features such as user authentication, file version control, and access controls, to help ensure the security and integrity of the files being shared.</p>
                <p>By implementing ShareLearn, your school can provide a more efficient and convenient way for students and teachers to collaborate and share knowledge, and can help to improve the overall learning experience for everyone involved.</p>
            </div>
        </div>

        <div id="TermsConditions" class="tabs">
            <div id="tac-list">
                <h4>1. Scope of Services</h4>
                <p>Our file sharing system is a service designed to enable students and teachers within the school to share files with each other. The files that can be shared include any type of file, and there are no restrictions.</p>
	
                <h4>2. User Conduct</h4>
                <p>Users of the file sharing system must conduct themselves in a manner that is consistent with the school's values and policies. Users must not engage in any activity that is illegal or that violates the rights of others.</p>
                
                <h4>3. Monitoring</h4>
                <p>We will monitor the use of the file sharing system, including recording the upload times and frequency of file sharing by students and teachers. This monitoring is intended to ensure that the file sharing system is used in accordance with the terms and conditions and to identify any potential misuse.</p>
                
                <h4>4. No Fees</h4>
                <p>Our file sharing system is provided to students and teachers at no cost.</p>
                
                <h4>5. Responsibility for Uploaded Files</h4>
                <p>Users are solely responsible for the files they upload and share through the file sharing system. Our system is not responsible for the content of the files shared or for any consequences that may arise from the use of the files.</p>
                
                <h4>6. No Third-Party Sharing</h4>
                <p>Files uploaded to the file sharing system will not be shared with any third-party websites or services.</p>
                
                <h4>7. User Privacy</h4>
                <p>We will protect the personal information of our users by not collecting any information other than the fact that the user is a student or teacher and the files that they upload. Cookies may be used to identify the user's device.</p>
                
                <h4>8. Acceptance of Terms and Conditions</h4>
                <p>By using our file sharing system, users agree to be bound by these terms and conditions. If a user does not agree to these terms and conditions, they must not use the file sharing system.</p>

            </div>
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
        <div id="reader-wrapper">
            <div style="width: 300px;"  id="reader"></div>
            <p style="background-color: white;">Sasjdasd</p>
        </div>
        
        <script src="scripts/onclickevents.js"></script>
        <script src="scripts/download.js"></script>
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