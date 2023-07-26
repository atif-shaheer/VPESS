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
                    <h6 class="m-0 font-weight-bold text-primary">Assign To Other</h6>

                    <div class="col-3 col-md-3 col-lg-3">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <select name="state" class="form-control">
                                            <option value="">Select a State</option>
                                            <?php
                                            $sql = "SELECT DISTINCT state FROM engineers";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row["state"] . '">' . $row["state"] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button style="padding: 8.8px;" type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <?php
// Check if the necessary parameters are provided
if (isset($_GET['employee_code']) && isset($_GET['site_id']) && isset($_GET['schedule_date'])) {
    // Get the values from the query parameters
    $employeeCode = $_GET['employee_code'];
    $siteId = $_GET['site_id'];
    $scheduleDate = $_GET['schedule_date'];

    // Check if the form is submitted
    if (isset($_POST['update_employee_code'])) {
        // Get the updated employee code from the form submission
        $updatedEmployeeCode = $_POST['employee_code'];

        // Perform the update operation here using the $updatedEmployeeCode

        // Example: Update the employee code in the database
        $sql = "UPDATE work SET employee_code = '$updatedEmployeeCode' WHERE site_id = '$siteId' AND schedule_date = '$scheduleDate'";
        if (mysqli_query($conn, $sql)) {
            // Success message
            echo "<script>window.alert('Task assign to new engineers successfully!');window.location.href='areaheadschedulesites.php';</script>";
        } else {
            // Error message
            echo "<script>alert('Failed to update employee code.');</script>";
        }
    }
}
?>


                <?php
                // Check if the necessary parameters are provided
                if (isset($_GET['employee_code']) && isset($_GET['site_id']) && isset($_GET['schedule_date'])) {
                    // Get the values from the query parameters
                    $employeeCode = $_GET['employee_code'];
                    $siteId = $_GET['site_id'];
                    $scheduleDate = $_GET['schedule_date'];

                    // Output the form for updating the work data
                ?>
                    <form method="post" class="p-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="siteIdInput">Site ID</label>
                                    <input type="text" class="form-control" id="siteIdInput" name="site_id" value="<?php echo $siteId; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="employeeCodeInput">Engineer Code</label>
                                    <input type="text" class="form-control" id="employeeCodeInput" name="employee_code" value="<?php echo $employeeCode; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="scheduleDateInput">Schedule Date</label>
                                    <input type="date" class="form-control" id="scheduleDateInput" name="schedule_date" value="<?php echo $scheduleDate; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for="employeeCodeInput" class="text-white">Engineer</label>
                                <button type="submit" name="update_employee_code" class="btn btn-primary"><i class="fa fa-check text-white" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>

                <?php
                } else {
                    // Error handling if parameters are missing
                    echo "Invalid request. Please provide the necessary parameters.";
                }
                ?>


                <div style='height: 250px;overflow-y:scroll;'>
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>Select Engineer</th>
                                <th>Employee Code</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $state = isset($_POST['state']) ? $_POST['state'] : '';
                            $sql = "SELECT * FROM engineers";

                            if (!empty($state)) {
                                $sql .= " WHERE state = '$state'";
                            }

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td><input type="radio" name="selected_engineer" value="' . $row['employee_code'] . '" onclick="document.getElementById(\'employeeCodeInput\').value = this.value;" ></td>';
                                    echo '<td>' . $row['employee_code'] . '</td>';
                                    echo '<td>' . $row['username'] . '</td>';
                                    echo '<td>' . $row['type'] . '</td>';
                                    echo '<td>' . $row['location'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">No engineers found.</td></tr>';
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