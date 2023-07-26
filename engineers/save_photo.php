<?php 
include('../config.php'); 
session_start();
?>

<?php
    if (isset($_POST['photoData'])) {
        $photoData = $_POST['photoData'];
        $employee_code = $_SESSION['employee_code'];

        // Save the photo in the "uploadfiles" folder
        $uploadDir = '../uploadfiles/';
        $filename = uniqid() . '.jpg'; // Generate a unique filename
        $filePath = $uploadDir . $filename;

        if (file_put_contents($filePath, base64_decode(explode(',', $photoData)[1]))) {

            if(function_exists('date_default_timezone_set')) {
                date_default_timezone_set("Asia/Kolkata");
            }

            $date = date("Y-m-d"); // Get the current date in the Indian timezone
            $pitime = date("H:i:s"); // Get the current time in the Indian timezone    

            $sql = "INSERT INTO punchinout (filename, date, pitime, employee_code) VALUES ('$filename', '$date', '$pitime', '$employee_code')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('You Have Successfully Punched In!'); window.location.href='punchinout.php';</script>";
            } else {
                echo 'Error saving photo in the database: ' . mysqli_error($conn);
            }
        } else {
            echo 'Error saving photo';
        }
    } else {
        echo 'No photo data received';
    }
?>

<?php
    if (isset($_POST['photoData2'])) {
        $photoData2 = $_POST['photoData2'];
        $employee_code = $_SESSION['employee_code'];

        // Save the photo in the "uploadfiles" folder
        $uploadDir = '../uploadfiles/';
        $filename = uniqid() . '.jpg'; // Generate a unique filename
        $filePath = $uploadDir . $filename;

        if (file_put_contents($filePath, base64_decode(explode(',', $photoData2)[1]))) {

            if(function_exists('date_default_timezone_set')) {
                date_default_timezone_set("Asia/Kolkata");
            }

            $potime = date("H:i:s"); // Get the current time in the Indian timezone

            $sql = "UPDATE punchinout SET filename = '$filename', potime = '$potime' WHERE date = CURDATE() AND employee_code = $employee_code";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('You Have Successfully Punched Out!'); window.location.href='punchinout.php';</script>";
            } else {
                echo 'Error saving photo in the database: ' . mysqli_error($conn);
            }
        } else {
            echo 'Error saving photo';
        }
    } else {
        echo 'No photo data received';
    }
?>