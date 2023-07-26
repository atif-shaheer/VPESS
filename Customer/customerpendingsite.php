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
                        $c_id = $_SESSION['c_id'];
                        $sql = "SELECT * FROM customer_work WHERE work_check = 'approved' AND rate_check = 'approved' AND work_status = 'Pending' AND c_id = '$c_id'";
                        $result = mysqli_query($conn, $sql);
                        echo "<table class='table table-bordered table-md'>";
                        echo "<thead class='thead-light'><tr>";
                        echo "<th style='text-align:center'>SN</th>";
                        // echo "<th style='text-align:center'>Verified Customer</th>";
                        // echo "<th style='text-align:center'>Check In</th>";
                        echo "<th style='text-align:center'>Ticket I'd</th>";
                        echo "<th style='text-align:center'>Site Name</th>";
                        echo "<th style='text-align:center'>Site Location</th>";
                        echo "<th style='text-align:center'>Site Address</th>";
                        echo "<th style='text-align:center'>Site I'd</th>";
                        echo "<th style='text-align:center'>Job Type</th>";
                        echo "<th style='text-align:center'>Comercial Rate</th>";
                        echo "<th style='text-align:center'>Job Details</th>";
                        echo "<th style='text-align:center'>Deadline</th>";
                        echo "<th style='text-align:center'>Contact Person</th>";
                        echo "<th style='text-align:center'>Contact Number</th>";
                        echo "<th style='text-align:center'>Work Order</th>";
                        echo "<th style='text-align:center'>Work Check</th>";
                        echo "<th style='text-align:center'>Rate Check</th>";
                        echo "<th style='text-align:center'>Work Status</th>";
                        echo "</tr></thead>";
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr onclick='displayData(" . $row['id'] . ")'>";
                                echo "<td>" . $row["id"] . "</td>";
                                // echo "<td style='text-align:center'><i style='font-size:20px;color:#39e339;' class='fas fa-check-circle'></i></td>";
                                // echo "<td><a href='checkins.php?id=" . $row['id'] . "' type='button' class='btn btn-primary'><i class='fas fa-clipboard-check'></i></a></td>"; // data-toggle='modal' data-target='.bd-example-modal-lg'
                                echo "<td>" . $row["ticket_id"] . "</td>";
                                echo "<td>" . $row["site_name"] . "</td>";
                                echo "<td>" . $row["location"] . "</td>";
                                echo "<td>" . $row["site_address"] . "</td>";
                                echo "<td>" . $row["site_id"] . "</td>";
                                echo "<td>" . $row["job"] . "</td>";
                                echo "<td>" . $row["commercial_rate"] . "</td>";
                                echo "<td>" . $row["job_details"] . "</td>";
                                echo "<td>" . $row["time_frame"] . "</td>";
                                echo "<td>" . $row["contact_person"] . "</td>";
                                echo "<td>" . $row["contact_number"] . "</td>";
                                echo "<td>" . $row["work_order"] . "</td>";
                                echo "<td>" . $row["work_check"] . "</td>";
                                echo "<td>" . $row["work_check"] . "</td>";
                                echo "<td>" . $row["work_status"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>


<?php include('customerfooter.php'); ?>