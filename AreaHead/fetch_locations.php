<?php
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<?php
// Assuming you have established a database connection

// Check if the state parameter is passed
if (isset($_POST['state'])) {
    $state = $_POST['state'];

    // Query the database to fetch locations based on the selected state
    $sql = "SELECT DISTINCT location FROM customer_work WHERE state = '$state'";
    $result = $conn->query($sql);

    $locations = array();

    if ($result->num_rows > 0) {
        // Fetch locations and store them in an array
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row['location'];
        }
    }

    // Return the locations as a JSON response
    echo json_encode($locations);
}
?>


