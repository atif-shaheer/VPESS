<?php include('areaheadheader.php'); ?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}
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
                    <h6 class="m-0 font-weight-bold text-primary">Engineers Report</h6>
                </div>
                <div class="table-responsive">
                    <div style="height: 450px;overflow-y:scroll;">
                        <?php
                        // $siteId = $_GET['siteId'];

                        $sql = "SELECT DISTINCT customer_work.site_name, work.site_id, customer_work.site_address, customer_work.job_details, 
                    work.schedule_date, customer_work.work_status, customer_work.installation_work, customer_work.remark_w, work.employee_code
                    FROM customer_work 
                    INNER JOIN work ON customer_work.site_id = work.site_id WHERE customer_work.work_status = 'Pending' ORDER BY schedule_date"; // Adjust the table and column names as per your database structure

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<table class='table table-bordered'>";
                            echo "<thead class='thead-light'><tr>";
                            echo "<th>E_Code</th>";
                            echo "<th>Site Name</th>";
                            echo "<th>Site ID</th>";
                            echo "<th>Site Address</th>";
                            echo "<th>Job Details</th>";
                            echo "<th>Schedule Date</th>";
                            echo "<th>Work Status</th>";
                            echo "<th>Installation Work</th>";
                            echo "<th>Remark</th>";
                            echo "</tr></thead>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['employee_code'] . "</td>";
                                echo "<td>" . $row['site_name'] . "</td>";
                                echo "<td>" . $row['site_id'] . "</td>";
                                echo "<td>" . $row['site_address'] . "</td>";
                                echo "<td>" . $row['job_details'] . "</td>";
                                echo "<td>" . $row['schedule_date'] . "</td>";
                                echo "<td>" . $row['work_status'] . "</td>";
                                echo "<td>" . $row['installation_work'] . "</td>";
                                echo "<td>" . $row['remark_w'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";
                        } else {
                            echo "<p>No data found for the selected employee.</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>

<?php include('areaheadfooter.php'); ?>