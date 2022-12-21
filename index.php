<!DOCTYPE html>
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
        <a href="#" onclick="closeSideBar(); openTab(event, 'About')" class="tablinks">About Sharelearn</a>
        <a href="#" onclick="closeSideBar(); openTab(event, 'Terms-and-Conditions')" class="tablinks">Terms and Conditions</a>
        <br><br><br><br><br><br>
        <a href="">Change User</a>
        <p>Current : Student</p>
        <a href="">Login</a>
        <p>For Researchers Only!</p>
    </div>

    <!-- Tabs -->
    <div>

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
                    <input type="text" name="mac-address" value="<?php echo exec('getmac'); ?>" hidden>
                    
                    <div id="upload-file">
                        <div class="forms-banner">
                            <h2 class="forms-title">Upload!</h2>
                            <p class="forms-description">Now, click the Upload button and locate your file for uploading.</p>
                        </div>
                        <div class="forms-body">
                            <label>
                                <input type="file" name="file" required>
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </label>
                        </div>
                        <div class="forms-footer">
                            <p class="note">Note:  Before uploading files, make sure that you've read our Terms and Conditions. </p>
                            <button type="submit" class="forms-next-button" name="submit">Upload</button>
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
                            # download
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
                                <input type="radio" name="action-type" value="upload">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <p class="forms-choice-description">Send File</p>
                            </label> 
                            <label>
                                <input type="radio" name="action-type" value="download" >
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <p class="forms-choice-description">Recieve File</p>
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
                
            <?php
                }else{
            ?>
                <!-- User Type Selection -->
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
                                <input type="radio" name="user-type" value="user" required>
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
                <!-- Upload File form-->
                <div id="upload-file">
                    <div class="forms-banner">
                        <h2 class="forms-title">Uploaded and Ready to Share!</h2>
                        <p class="forms-description">You can share it by copying and sending the code to someone you want to share the file with. </p> 
                    </div>
                    <br>
                    <div class="forms-body" id="code-input-body">
                        <input type="text" id="code-input" name="action-type" placeholder="Code...">
                    </div>
                    <br>
                    <div class="forms-footer">
                        <p class="note">Note:  Uploaded Files are only available within the day.  </p>
                        <button type="button" class="forms-next-button">Next</button>
                    </div>
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