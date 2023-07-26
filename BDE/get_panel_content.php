<?php
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<?php
// Assuming you have a database connection established already

// Check if the siteId parameter is provided
if (isset($_GET['siteId'])) {
    $siteId = $_GET['siteId'];

    // Perform the SQL query to retrieve the panel content
    $sql = "SELECT DISTINCT customer_work.site_name, work.site_id, customer_work.site_address, customer_work.job_details, work.schedule_date, customer_work.work_status, customer_work.installation_work, customer_work.remark_w 
            FROM customer_work 
            INNER JOIN work ON customer_work.site_id = work.site_id 
            WHERE work.site_id = '$siteId'"; // Adjust the table and column names as per your database structure

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display the panel content
        $row = mysqli_fetch_assoc($result);

        echo "<table class='table table-bordered'>";
        echo "<tr><th>Site Name</th><td>" . $row['site_name'] . "</td></tr>";
        echo "<tr><th>Site ID</th><td>" . $row['site_id'] . "</td></tr>";
        echo "<tr><th>Site Address</th><td>" . $row['site_address'] . "</td></tr>";
        echo "<tr><th>Job Details</th><td>" . $row['job_details'] . "</td></tr>";
        echo "<tr><th>Schedule Date</th><td>" . $row['schedule_date'] . "</td></tr>";
        echo "<tr><th>Work Status</th><td>" . $row['work_status'] . "</td></tr>";
        echo "<tr><th>Installation Work</th><td>" . $row['installation_work'] . "</td></tr>";
        echo "<tr><th>Remark</th><td>" . $row['remark_w'] . "</td></tr>";
        echo "</table>";
    } else {
        echo "<p>No data found for the selected site.</p>";
    }
} else {
    echo "<p>Invalid request. Please provide the necessary parameters.</p>";
}
