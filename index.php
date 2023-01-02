<?php
    include 'php/connection.php';

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
        if (!setcookie("device_id",$uniqueIdGeneration)) {
            echo "There's an error with the cookie setting. Please contact XANDER ISON for this issue";
        }
    }
?>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/animations.css">
    <script src="https://kit.fontawesome.com/6b9c8a6e93.js" crossorigin="anonymous"></script>
    <script src="scripts/index.js" defer></script>
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
        ShareLearn
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
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </label>
                        </div>
                        <div class="forms-footer">
                            <p class="note">Note:  Before uploading files, make sure that you've read our Terms and Conditions. </p>
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
                        <p class="note">Note: Upload speed may vary. </p>
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

                            <input type="text" id="code-input" name="file-code">
                        </div>
                        <div class="forms-footer">
                            <p class="note">Note:  Before uploading files, make sure that you've read our Terms and Conditions. </p>
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
                        <p class="note">Note: Searching speed may vary. </p>
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
                        <p class="note">Note:  Uploaded Files are only available within the day.  </p>
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
                        <p class="note">Note:  Uploaded Files are only available within the day.  </p>
                        <form action="php/download.php" method="post">
                            <input type="text" name="file-code" value='<?php echo $row["file_code"]?>' hidden>
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
                                <input type="radio" name="user-type" value="teacher" required>
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
            <?php
                }
            ?>
                
        </div>
        
        <!-- My Uploads -->
        <div id="MyUploads" class="tabs" style="display:none">
            <h2 align="center">My<font color="#0B8043">Uploads</font></h2>
            <p class="note">Note:  </p>
            <div id="uploads-list">
            <table id="uploads-list-table">
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

                        while ($row = mysqli_fetch_array($result) ) {
                        ?>
                        <tr>
                            <td>
                                <?php echo substr($row["file_name"], 10)?>
                            </td>
                            <td>
                                <?php echo date("M j, Y g:i a", strtotime($row["uploaded_date"]));   ?>
                            </td>
                            <td onclick="copyThisText('<?php echo $row["file_code"]?>')" class="code-copy">
                                <?php echo $row["file_code"]?>
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
            <h2 align="center">What is <font color="#0B8043">Sharelearn</font>?</h2>
            <p>Paris is the capital of France.</p> 
        </div>

        <!-- Terms and Conditions Tab -->
        <div id="Terms-and-Conditions" class="tabs" style="display:none">
            <h2>Tokyo</h2>
            <p>Tokyo is the capital of Japan.</p>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>