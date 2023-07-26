<?php 
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<!-- HTML code for Bootstrap tab -->
<div class="container">
  <!-- <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#image_tab"></a></li>
  </ul> onclick="downloadPDF()" -->
  <?php
if (isset($_POST['download_images'])) {
    $site_id = $_GET['site_id'];
    $folder_name = $site_id;

    // Create the folder if it doesn't exist
    if (!file_exists($folder_name)) {
        mkdir($folder_name);
    }

    // Query the database to retrieve images
    $sql = "SELECT report_format FROM engineers WHERE site_id = '$site_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image_url = "../uploadfiles/" . $row['report_format'];
            $image_name = basename($image_url);
            $file_path = $folder_name . "/" . $image_name;
            copy($image_url, $file_path);

            // Download the image using cURL
            $ch = curl_init($image_url);
            $fp = fopen($file_path, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            if(curl_errno($ch))
            {
                echo 'Error downloading image: ' . curl_error($ch);
            }
        }

        echo "Images downloaded successfully!";
    } else {
        echo "No images found for this site ID.";
    }
}
?>


<!-- <form method="post">
    <button type="submit" name="download_images" download>Download Images</button>
</form> -->


  <div class="tab-content">
    <div id="image_tab" class="tab-pane fade in active">
    <?php
        $site_id = $_GET['site_id'];

        $sql = "SELECT * FROM engineers WHERE site_id = '$site_id'";
        $result = $conn->query($sql);

        // Loop through the result set and display images in the Bootstrap tab
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $images = explode(',', $row['report_format']);
                $count = 0;
                foreach ($images as $image) {
                    if ($count < 15) {
                        echo "<a href='../uploadfiles/$image' download><img src='../uploadfiles/$image' width='500' height='500' class='img-thumbnail'></a>";
                        $count++;
                    }
                }
            }
        } else {
            echo "No images found for the given site_id";
        }
        ?>
    </div>
  </div>
</div>