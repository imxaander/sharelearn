<?php
    #connection to database
    include 'connection.php';
    include 'functions.php';

    if ($_GET["q"] == "fileTypes") {
        $sql = "SELECT file_name FROM files";
        $result = mysqli_query($con, $sql);
        
        // Step 2: Extract the file extension for each file name
        $extensions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $extension = pathinfo($row['file_name'], PATHINFO_EXTENSION);
            $extensions[] = $extension;
        }
        
        // Step 3: Count the number of occurrences of each file extension and calculate their percentage
        $total_files = count($extensions);
        $unique_extensions = array_unique($extensions);
        $extension_counts = array_count_values($extensions);
        
        $percentages = array();
        foreach ($unique_extensions as $extension) {
            $count = isset($extension_counts[$extension]) ? $extension_counts[$extension] : 0;
            $percent = round($count / $total_files * 100, 2);
            $percentages[$extension] = $percent;
        }
        
        // Step 4: Pass the data to Chart.js to generate a pie chart
        $data = array();
        foreach ($percentages as $extension => $percent) {
            $data[] = array(
                "label" => $extension,
                "value" => $percent
            );
        }
        
        echo json_encode($data);
        
      }