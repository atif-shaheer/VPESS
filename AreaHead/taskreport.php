<?php include('areaheadheader.php'); ?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}
?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}
?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM customer_work WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
                  <h6 class="m-0 font-weight-bold text-primary">Task Report</h6>
                </div>
                <div class="table-responsive">

                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>Report Format PDF</th>
                        <th>Report Format</th>
                        <th>Site Name</th>
                        <th>Site ID</th>
                        <th>Site Address</th>
                        <th>Job Details</th>
                        <th>Time Frame</th>
                        <th>Engineer Name</th>
                        <th>Employee Code</th>
                        <th>Employee Type</th>
                        <th>Work Status</th>
                        <th>Installation Work</th>
                        <th>Remark W</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        session_start();
                        if(isset($_SESSION['username'])){
                            $username = $_SESSION['username'];
                        }
                        //$query = "SELECT * FROM customer_work WHERE ahusername = '$username'";
                        $query = "SELECT customer_work.id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                        customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, customer_work.work_status, 
                        customer_work.installation_work, area_head.username as auser, engineers.remark_w, engineers.report_format, engineers.report_format_pdf FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                        customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND customer_work.id = $id";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><a href='../uploadfiles/" . $row['report_format_pdf'] . "' download><i class='fa fa-download'></i></a></td>";
                            echo "<td>";
                            $images = explode(',', $row['report_format']);
                            $count = 0;
                            foreach ($images as $image) {
                                if ($count < 1) {
                                    echo "<a href='download_pdf.php?site_id=" . $row['site_id'] . "' target='_blank'><img src='../uploadfiles/$image' width='50' height='50'></a>";
                                    $count++;
                                }
                            }
                            echo "</td>";
                            echo "<td>" . $row['site_name'] . "</td>";
                            echo "<td>" . $row['site_id'] . "</td>";
                            echo "<td>" . $row['site_address'] . "</td>";
                            echo "<td>" . $row['job_details'] . "</td>";
                            echo "<td>" . $row['time_frame'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" .$row['employee_code'] ."</td>";
                            echo "<td>" .$row['type'] ."</td>";
                            echo "<td>" .$row['work_status'] ."</td>";
                            echo "<td>" .$row['installation_work'] ."</td>";
                            echo "<td>" .$row['remark_w'] ."</td>";                          
                            echo "</tr>";
                        }
                        } else {
                        echo "<tr><td colspan='6'>No results found.</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

    </div>
</div>

<?php include('areaheadfooter.php'); ?>