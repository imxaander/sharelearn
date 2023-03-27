<?php
    #connection to database
    include 'connection.php';
    include 'functions.php';

    if (isset($_POST["file_code"])) {
        $file_code = $_POST["file_code"];
        
        #check if the file with the file code exists
        $sql = "SELECT * FROM files WHERE file_code = '$file_code'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result)?>
                <p id="file-name-preview"><?php echo substr($row["file_name"], 15)?></p>
                <p><i class="fa-solid fa-hard-drive"></i> <?php echo format_speed($row["file_size"])?> </p>
                <p><i class="fa-solid fa-clock"></i> <?php echo date("M jS, Y - H:i a", strtotime($row["uploaded_date"]))?> </p>
                <form action="php/download.php" method="post">
                <input type="text" name="file-code" value="<?php echo $row['file_code']?>" hidden>
                <button id="downloadBtn" type="submit">Download</button> 
                </form>
        <?php
        }else{ 
            echo "no file";
        }
    }else{
        echo "no code";
        echo $_POST["file_code"];
    }
?>
