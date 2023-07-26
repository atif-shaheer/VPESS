<?php include('customerheader.php'); ?>

<?php
// session_start(); // start the session

// // check if the user is not logged in, redirect to the login page
// if (!isset($_SESSION["employee_code"])) {
//     header("Location: areaheadlogin.php");
//     exit();
// }
?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["c_id"])) {
    header("Location: areaheadlogin.php");
    exit();
}
?>

<?php
// $id = $_GET['id'];
// $sql = "SELECT * FROM customer_work WHERE id = $id";
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
?>

<div class="container-fluid" id="container-wrapper">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="areaheadindex.php">Home</a></li>
            <li class="breadcrumb-item">Engineer</li>
            <li class="breadcrumb-item active" aria-current="page">Add Engineers</li>
        </ol>
    </div> -->

    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Sites</h6>
                    <div class="col-3 col-md-3 col-lg-3">
                        <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="input-group">
                                <input type="text" name="site_id" class="form-control" placeholder="Please Enter Site Id" required>
                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form> -->
                    </div>
                </div>
                <div class="table-responsive">
                    <div style="height: 500px;overflow-y:scroll;">

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
                        ?>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>


<?php include('customerfooter.php'); ?>