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
    <div id="dim-pane" onclick="closeFromDim()"></div>
    <div id="top-bar">
        <p id="top-text-header" onclick="colOrex()">PARAÑAQUE NATIONAL HIGH SCHOOL - MAIN - Home of the Gentle Warriors</p>
    </div>
    
    <div id="top-nav-bar">
        <i class="fas fa-bars" aria-hidden="true" id="open-side-bar-button" onclick="openSideBar()"></i>
        <img src="img/pnhs_logo_255px.jpg" id="pnhslogo40px">
        ShareLearn
    </div>

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

    <div >
        <div id="Home" class="tabs">
            <form action="">

            </form>
        </div>

        <div id="About" class="tabs" style="display:none">
            <h2 align="center">What is Sharelearn?</h2>
            <p>Paris is the capital of France.</p> 
        </div>

        <div id="Terms-and-Conditions" class="tabs" style="display:none">
            <h2>Tokyo</h2>
            <p>Tokyo is the capital of Japan.</p>
        </div>
    </div>
</body>
</html>