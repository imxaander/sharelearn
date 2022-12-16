<!DOCTYPE html>
<html lang="en">
<head>
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

            <!-- User Type Selection -->
            <form action="">
                <div id="User-Selection">
                    <div class="forms-banner">
                        <h2 class="forms-title">Welcome!</h2>
                        <p class="forms-description">Before using ShareLearn, please tell us If you’re a :</p> 
                    </div>
                    <div class="forms-body">
                        <label>
                            <input type="radio" name="user-type" value="teacher">
                            <i class='fas fa-chalkboard-teacher'></i>
                            <p class="forms-choice-description">Teacher</p>
                        </label> 
                        <label>
                            <input type="radio" name="user-type" value="user" >
                            <i class='fas fa-user-graduate'></i>
                            <p class="forms-choice-description">Student</p>
                        </label>
                    </div>
                    <br>
                    <div class="forms-footer">
                        <button class="forms-next-button">Next</button>
                    </div>
                </div>

                <!-- Action Selection -->
                <div id="">
                    <div class="forms-banner">
                        <h2 class="forms-title">Next!</h2>
                        <p class="forms-description">Do you want to:</p> 
                    </div>
                    <div class="forms-body">
                        <label>
                            <input type="radio" name="action-type" value="teacher">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <p class="forms-choice-description">Send File</p>
                        </label> 
                        <label>
                            <input type="radio" name="user-type" value="user" >
                            <i class="fa fa-download" aria-hidden="true"></i>
                            <p class="forms-choice-description">Recieve File</p>
                        </label>
                    </div>
                    <br>
                    <div class="forms-footer">
                        <button class="forms-next-button">Next</button>
                    </div>
                </div>
            </form>
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

</body>
</html>