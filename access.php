<?php
    include 'php/connection.php';
    
    $device_id = $_COOKIE["device_id"];
    //fetch guest id, role,  from device_id
    $sql = "SELECT * FROM guests WHERE device_id ='$device_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="libs/css/bootstrap.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/fonts.css">
        <link rel="stylesheet" href="styles/animations.css">
        <link href="libs/fontawesome 6/css/all.css" rel="stylesheet">
        <link href="styles/access.css" rel="stylesheet">
        <script defer src="libs/fontawesome 6/js/all.js"></script>
        <script src="libs/chartjs/dist/chart.umd.js"></script>

        <title>Login & Register - ShareLearn</title>
    </head>
    <body>
        <p id="backdrop-text">ShareLearn.</p>
        <div id="forms-wrapper">
            <div id="forms-lr">
                <div id="action-select-access" class="forms-lr">
                    <button class="forms-next-button" onclick="openLog()">Login</button>
                    <button class="forms-next-button" onclick="openSign()">Register</button>
                    <a href="#" class="green" onclick="continueAsGuest()">Continue as Guest</a>
                </div>
                <div id="login-form"  class="form-group forms-lr">
                    <p class="back-button" onclick="goBack()">‹</p>
                    <br>
                    <h3><b>Login</b></h3>
                    <br>
                    <form action="php/login.php" method="post">
                        <p class="control-labels">Username</p>
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                        <p class="control-labels">Password</p>
                        <input type="password" class="form-control" name="username" placeholder="Enter password">
                        <br>
                        <button class="forms-next-button" type="submit">Login</button>
                    </form>
                </div>
                <div id="register-form" action="php/register.php" method="post" class="form-group forms-lr">
                    <p class="back-button" onclick="goBack()">‹</p>
                    <br>
                    <h3><b>Sign Up </b></h3>
                    <br>
                    <form action="php/register.php" method="post">
                        <p class="control-labels">Username</p>
                        <input type="text" class="form-control" name="username" placeholder="Enter username">
                        <p class="control-labels">Email</p>
                        <input type="text" class="form-control" name="email" placeholder="Enter email">
                        <p class="control-labels">Password</p>
                        <input type="text" class="form-control" name="password"  placeholder="Enter password">
                        <p class="control-labels">Role</p>
                        <select class="form-control" name="role">
                            <option <?php echo ($row["role"] == 'student') ? "selected" : ''; ?> value="student">Student</option>
                            <option <?php echo ($row["role"] == 'teacher') ? "selected" : ''; ?> value="teacher">Teacher</option>
                        </select>
                        <p class="control-labels">Grade and Section</p>
                        <select name="grade_section" id="" class="form-control">
                            <option value="TVL - ALLEN">TVL - ALLEN</option>
                            <option value="TVL - DELL">TVL - DELL</option>
                        </select>

                        <input type="text" name="device_id" disabled value="<?php echo $row["device_id"]?>" hidden>
                        <br>
                        <button class="forms-next-button" type="submit">Sign up</button>
                    </form>
                </div>
            </div>
            
        </div>
        <script src="libs/js/jquery.js"></script>
        <script src="scripts/access.js"></script>
        <script src="libs/js/popper.min.js" crossorigin="anonymous"></script>
        <script src="libs/js/bootstrap.min.js"></script>
    </body>
</html>