<?php
    include 'php/connection.php';
    include 'php/functions.php';

    if (isset($_COOKIE["device_id"])) {
        $device_id=$_COOKIE["device_id"];
        $sql = "SELECT guest_id FROM guest WHERE device_id = '$device_id'";
        $result = mysqli_query($con, $sql);

        if($result){
            while($row = mysqli_fetch_array($result)) {
                $current_guest_id = $row["guest_id"];
            }
        }
    }

    if(isset($_GET["uploaded"])){
        $upload_id = $_GET["uploaded"];
        $sql = "SELECT * FROM files WHERE file_code='$upload_id'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $uploaded = $row["file_code"];
        }else{
            $uploaded = "redirectHome";
        }
    }else{
        $uploaded = "redirectHome";
    }

    if(isset($_GET["search"])){
        $file_code = $_GET["search"];
        $sql = "SELECT * FROM files WHERE file_code='$file_code'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $file_code = $row["file_code"];
        }else{
            $file_code = "redirectHome";
        }
    }else{
        $file_code = "redirectHome";
    }

    if(!isset($_COOKIE["device_id"])){
        $uniqueIdGeneration = uniqid("SLUSER");
        $cookieExpiration = 366;
        if (!setcookie("device_id",$uniqueIdGeneration, time()+60*60*24*$cookieExpiration)) {
            echo "There's an error with the cookie setting.";
        }else{
            header("Refresh:0");
        }
    }


?>
<html lang="en">
<head>
<link rel="stylesheet" href="libs/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/animations.css">
    <script defer src="libs/fontawesome 6/js/all.js"></script>
    <link href="libs/fontawesome 6/css/all.css" rel="stylesheet">
    <script src="scripts/index.js" defer></script>
    <script src="libs/chartjs/dist/chart.umd.js"></script>
    <title>ShareLearn - Paranaque National Highschool - Main</title>
</head>
<body>
    <!-- Dim Panel -->
    <div id="dim-pane" onclick="closeFromDim()"></div>

    <!-- Top Bar-->
    <div id="top-bar">
        <p id="top-text-header" onclick="colOrex()">PARAÑAQUE NATIONAL HIGH SCHOOL - MAIN - Home of the Gentle Warriors</p>
    </div>

    <!-- Top Navigation Bar -->
    <div id="top-nav-bar">
        <i class="fas fa-bars" aria-hidden="true" id="open-side-bar-button" onclick="openSideBar()"></i>
        <img src="img/pnhs_logo_255px.jpg" id="pnhslogo40px">
    </div>

    <!-- Side Navigation Bar -->
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

    <!-- Tabs -->
    <div id="tabs">

        <!-- Home Tab -->
        <div id="Home" class="tabs">
            <?php
                if (isset($_POST["user-type"])) {
                    if (isset($_POST["action-type"])) {
                        if ($_POST["action-type"] == "upload") {
                            # i love you thea mwa mwa
            ?>
                <!-- Upload File form-->
                <form action="php/upload.php" enctype="multipart/form-data" method="post">
                    <input type="text" name="user-type" value="<?php echo $_POST["user-type"]; ?>" hidden>
                    <input type="text" name="device-id" value="<?php
                        if (isset($_COOKIE["device_id"])) {
                            echo $_COOKIE["device_id"];
                        }else{
                            echo "NO COOKIES FOUND";
                        }
                    ?>" hidden>

                    <?php
                        //check if this "device_id" is set, then get the guest id and pass it.
                        
                        if (isset($_COOKIE["device_id"])) {
                            $device_id=$_COOKIE["device_id"];
                            $sql = "SELECT * FROM guest WHERE device_id = '$device_id'";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);  

                            ?>
                    
                    <input type="text" name="guest-id" value="<?php echo $row["guest_id"]; ?>" hidden>
                    <?php
                            }
                        }
                    ?>
                    
                    <div id="upload-file">
                        <div class="forms-banner">
                            <h2 class="forms-title">Upload!</h2>
                            <p class="forms-description">Now, click the Upload button and locate your file for uploading.</p>
                        </div>
                        <div class="forms-body">
                            <label>
                                <input type="file" id="file-input"name="file" required>
                                <i class="fas fa-upload" aria-hidden="true"></i>
                            </label>
                        </div>
                        <div class="forms-footer">
                            <p class="note"><b> Note </b>:  Before uploading files, make sure that you've read our Terms and Conditions. </p>
                            <button type="button" onclick="history.back()"class="forms-next-button" name="submit">Back</button>
                            <button type="submit" id="upload-button" class="forms-next-button" name="submit">Upload</button>
                        </div>
                    </div>
                </form>
                <!-- Upload Loading -->
                <div id="upload-loading">
                    <div class="forms-banner">
                        <h2 class="forms-title">Uploading!</h2>
                        <p class="forms-description">Wait for it to upload.</p> 
                    </div>
                    <div class="forms-body">
                        <i class="fa fa-spinner fa-spin" style="color: #0B8043" aria-hidden="true"></i>
                    </div>
                    <div class="forms-footer">
                        <p class="note"><b> Note </b>: Upload speed may vary. </p>
                    </div>

                </div>
            <?php
                        }elseif ($_POST["action-type"] == "download") {
            ?>
                <!-- Download File form-->
                <form action="php/search.php" method="post">
                    <input type="text" name="user-type" value="<?php echo $_POST["user-type"]; ?>" hidden>
                    <input type="text" name="device-id" value="<?php
                        if (isset($_COOKIE["device_id"])) {
                            echo $_COOKIE["device_id"];
                        }else{
                            echo "NO COOKIES FOUND";
                        }
                    ?>" hidden>

                    <?php
                        //check if this "device_id" is set, then get the guest id and pass it.
                        
                        if (isset($_COOKIE["device_id"])) {
                            $device_id=$_COOKIE["device_id"];
                            $sql = "SELECT * FROM guest WHERE device_id = '$device_id'";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);    
                            ?>

                    <input type="text" name="guest-id" value="<?php echo $row["guest_id"]; ?>" hidden>
                    <?php
                            }
                        }
                    ?>
                    
                    <div id="download-file">
                        <div class="forms-banner">
                            <h2 class="forms-title">Receive!</h2>
                            <p class="forms-description">Now, paste or type the file code that has been shared to you, then click search</p>
                        </div>
                        <div class="forms-body" id="code-input-body">
                            <i class="fa fa-clipboard" aria-hidden="true" id="paste-id-button"></i>

                            <input type="text" id="code-input" name="file-code" required>
                        </div>
                        <div class="forms-footer">
                            <p class="note"><b> Note </b>:  if search button returns you here, it means that there is no file with the code entered. </p>
                            <button type="button" onclick="history.back()"class="forms-next-button" name="submit">Back</button>
                            <button type="submit" id="search-button" class="forms-next-button" name="submit">Search</button>
                        </div>
                    </div>
                </form>

                <!-- Download Loading -->
                <div id="download-loading">
                    <div class="forms-banner">
                        <h2 class="forms-title">Checking...</h2>
                        <p class="forms-description">Wait for it to search for the file.</p> 
                    </div>
                    <div class="forms-body">
                        <i class="fa fa-spinner fa-spin" style="color: #0B8043" aria-hidden="true"></i>
                    </div>
                    <div class="forms-footer">
                        <p class="note"><b> Note </b>: Searching speed may vary. </p>
                    </div>

                </div>
            <?php
                        }
            ?> 
            <?php
                    }else{
            ?>
                <!-- Action Type Selection --> 
                <form action="index.php" method="post">
                    <input type="text" name="user-type" value="<?php echo $_POST["user-type"]; ?>" hidden>
                    <div id="action-selection">
                        <div class="forms-banner">
                            <h2 class="forms-title">Next!</h2>
                            <p class="forms-description">Do you want to:</p> 
                        </div>
                        <div class="forms-body">
                            <label>
                                <input type="radio" name="action-type" value="upload" required>
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <p class="forms-choice-description">Send File</p>
                            </label> 
                            <label>
                                <input type="radio" name="action-type" value="download" required>
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <p class="forms-choice-description">Receive File</p>
                            </label>
                        </div>
                        <br>
                        <div class="forms-footer">
                            <button type="button" onclick="history.back()"class="forms-next-button" name="submit">Back</button>
                            <button type="submit" class="forms-next-button">Next</button>
                        </div>
                    </div>       
                </form>
            <?php
                }
            ?>
                
            <?php
                }elseif(isset($_GET["uploaded"])){
                    if ($uploaded != "redirectHome") {?>
                    
                <!-- Upload File form-->
                <div id="upload-file">
                    <div class="forms-banner">
                        <h2 class="forms-title">Uploaded and Ready to Share!</h2>
                        <p class="forms-description">You can share it by copying and sending the code to someone you want to share the file with. </p> 
                    </div>
                    <br>
                    <div class="forms-body" id="code-input-body">
                        <i class="fa fa-clone" aria-hidden="true" id="copy-id-button"></i>
                        <input type="text" id="code-input" name="action-type" disabled value="<?php echo $row["file_code"];?>">
                    </div>
                    <br>
                    <div class="forms-footer">
                        <p class="note"><b> Note </b>:  Uploaded Files are only available within the day.  </p>
                        <form action="">
                            <button type="submit" class="forms-next-button" >Back to Home</button>
                            <button type="button" onclick="history.back()"class="forms-next-button" name="submit">Upload More</button>
                        </form>
                    </div>
                </div>
            <?php
                    }else{
                        header("Location: ../");
                    }
                }elseif($file_code != 'redirectHome'){
            ?>
                <!-- Download File form-->
                <div id="download-file">
                    <div class="forms-banner">
                        <h2 class="forms-title">File found!</h2>
                        <p class="forms-description">There is no preview for this file. Click download to download the file. </p> 
                    </div>
                    <br>
                        <p style="text-align: center;"> <?php echo substr($row["file_name"], 10)?></p>
                    <br>
                    <div class="forms-footer">
                        <p class="note"><b> Note </b>:  Uploaded Files are only available within the day.  </p>
                        <form action="php/download.php" method="post">
                            
                            <input type="text" name="guest-id" value="<?php echo $current_guest_id ?>" hidden>
                            <input type="text" name="file-code" value='<?php echo $row["file_code"]?>' hidden>
                            <button type="button" onclick="history.back()"class="forms-next-button" name="submit">Back</button>
                            <button type="submit" class="forms-next-button" name="submit">Download</button>
                        </form>
                    </div>
                </div>
            <?php
                }else{
            ?>
                <!-- User Type Selection -->
                <?php
                    if(isset($_GET["error"])){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong> <?php echo $_GET["error"]?> </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
                </div>
                <?php
                    }
                ?>
                <form action="index.php" method="post">
                    <div id="user-selection">
                        <div class="forms-banner">
                            <h2 class="forms-title">Welcome!</h2>
                            <p class="forms-description">Before using ShareLearn, please tell us If you're a :</p> 
                        </div>
                        <div class="forms-body">
                            <label>
                                <input type="radio" id="sd" name="user-type" value="teacher" required>
                                <i class='fas fa-chalkboard-teacher'></i>
                                <p class="forms-choice-description">Teacher</p>
                            </label> 
                            <label>
                                <input type="radio" name="user-type" value="student" required>
                                <i class='fas fa-user-graduate'></i>
                                <p class="forms-choice-description">Student</p>
                            </label>
                        </div>
                        <br>
                        <div class="forms-footer">
                            <button type="submit" class="forms-next-button">Next</button>
                        </div>
                    </div>
                </form>
                <!-- end  uwu testing -->
                <div>
                    <canvas id="myPieChart"></canvas>
                </div>

                <!-- logs -->
                <div id="logs">

                    <?php displayLogs("","") ?>

                </div>

            <?php
                }
            ?>
                
        </div>
        
        <!-- My Uploads -->
        <div id="MyUploads" class="tabs" style="display:none">
        <br>
            <h2 align="center" class="bold">My <font color="#0B8043">Uploads</font></h2>
            <p class="note"><b> Note </b>:  Click the file code to copy it.</p>
            <div id="uploads-list">
            <table class="table">
                <tr>
                    <th>File Name</th>
                    <th>Date Uploaded</th>
                    <th>Code</th>
                </tr>
            <?php
                //search for this device id, then if exists on the database, display all the files you have uploaded
                //containing the file name, code, expiration
                $current_device_id = $_COOKIE["device_id"]; 
                $sql = "SELECT * FROM guest WHERE device_id = '$current_device_id'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {

                    $row = mysqli_fetch_assoc($result);
                    $guest_id = $row["guest_id"]; 
                    $sql = "SELECT * FROM files WHERE guest_id = '$guest_id'";
                    $result = mysqli_query($con, $sql);

                    if ($result) {

                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo substr($row["file_name"], 10)?>
                            </td>
                            <td>
                                <?php echo date("M j, Y g:i a", strtotime($row["uploaded_date"]));   ?>
                            </td>
                            <td onclick="copyThisText('<?php echo $row["file_code"]?>')">
                                <p class="code-copy"><?php echo $row["file_code"]?></p>
                            </td>
                        </tr>
                        <?php
                        }
                    }else{
                        echo "failed to check result";
                    }
                }else{
            ?>
                    <p align="center">No files have been uploaded.</p>
            <?php
                }
            ?>
                </table>
            </div>
        </div>

        <!-- About Tab -->
        <div id="About" class="tabs" style="display:none">
            <br>
            <h2 align="center" class="bold"><font color="#0B8043">ShareLearn</font></h2>
            <p class="bold">A Convenient and Collaborative File Sharing System for PNHS</p>

            <div id="about-desc">
                <p>ShareLearn is a file sharing system designed to help students and teachers at your school easily and efficiently share files with one another. With ShareLearn, users can upload and download files to a central location within the school's network, making it easy to access important course materials, assignments, and other resources.</p>
                <p>The system is named ShareLearn because it is intended to facilitate knowledge sharing and collaboration among students and teachers. By providing a centralized platform for file sharing, ShareLearn can help to reduce the time and effort required to manage and distribute course materials, and can help to foster a more collaborative learning environment.</p>
                <p>In addition to its file sharing capabilities, ShareLearn also includes features such as user authentication, file version control, and access controls, to help ensure the security and integrity of the files being shared.</p>
                <p>By implementing ShareLearn, your school can provide a more efficient and convenient way for students and teachers to collaborate and share knowledge, and can help to improve the overall learning experience for everyone involved.</p>
            </div>
        </div>

        

        <!-- Terms and Conditions Tab -->
        <div id="Terms-and-Conditions" class="tabs" style="display:none">
        <br>
            <h2  align="center" class="bold" > <font color="#0B8043">Terms and Conditions</font></h2>
            <br>
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

                <button onclick="closeSideBar(); openTab(event, 'Home')" type="button" id="agree-btn" class="forms-next-button" style="  display: block;
  margin: 0 auto; color: white;" >I Agree</button>
            </div>
        </div>

    </div>
    <script src="libs/js/jquery.js"></script>
    <script src="libs/js/popper.min.js" 
                crossorigin="anonymous">
    </script>
    <script src="libs/js/bootstrap.min.js"></script>
</body>
</html>