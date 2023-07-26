<?php
include('areaheadheader.php');
session_start();

if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}
?>

<?php
$selectedSites = isset($_GET['ids']) ? explode(",", $_GET['ids']) : [];

foreach ($selectedSites as $siteId) {
    $sql = "SELECT site_id FROM customer_work WHERE id = $siteId";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $siteId = $row['site_id'];

    // echo "<div class='form-check ml-3 mt-1'>";
    // echo "<input class='form-check-input' type='checkbox' name='selected_sites[]' value='" . $siteId . "' id='" . $siteId . "'>";
    // echo "<label  class='form-check-label' for='" . $siteId . "'>" . $siteId . "</label>";
    // echo "</div>";
}

?>

<div class="container-fluid" id="container-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <h6 class="m-0 font-weight-bold text-primary">Assign Task To Engineers</h6>
                    
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
                <div class="card-body">

                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div style="height: 250px;overflow-y:scroll;">
                                    <table class='table table-bordered table-md' id="siteTable">

                                        <thead class='thead-light'>
                                            <tr>
                                                <th>Select</th>
                                                <th>Site ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $selectedSites = isset($_GET['ids']) ? explode(",", $_GET['ids']) : [];

                                            foreach ($selectedSites as $siteId) {
                                                $sql = "SELECT site_id FROM customer_work WHERE id = $siteId";
                                                $result = mysqli_query($conn, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $siteId = $row['site_id'];

                                                echo "<tr>";
                                                echo "<td>";
                                                echo "<input class='form-check-input' type='checkbox' name='selected_sites[]' value='" . $siteId . "' id='" . $siteId . "'>";
                                                echo "</td>";
                                                echo "<td>" . $siteId . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <?php
                                $state = isset($_POST['state']) ? $_POST['state'] : '';
                                $sql = "SELECT * FROM engineers";

                                if (!empty($state)) {
                                    $sql .= " WHERE state = '$state'";
                                }

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    echo "<div style='height: 250px;overflow-y:scroll;'>";
                                    echo "<table class='table table-bordered table-md' id='engineerTable'>";

                                    echo "<thead class='thead-light'>";
                                    echo "<tr>";
                                    echo "<th>Select Engineers</th>";
                                    echo "<th>E_Code</th>";
                                    echo "<th>Type</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>City</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<input type='checkbox' name='selected_engineers[]' value='" . $row['employee_code'] . "'>";
                                        echo "</td>";
                                        // echo "<td>$siteId</td>";
                                        echo "<td>" . $row['employee_code'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";

                                        // echo "<td><input type='date' name='" . $row['employee_code'] . "'></td>";
                                        echo "</tr>";
                                    }

                                    echo "</tbody>";

                                    echo "</table>";
                                    echo "</div>";
                                } else {
                                    echo "No engineers found.";
                                }
                                ?>
                            </div>
                        </div>

                        <?php
// if (isset($_POST['assign'])) {
//     // Retrieve the selected sites and engineers
//     $selectedSites = isset($_POST['selected_sites']) ? $_POST['selected_sites'] : [];
//     $selectedEngineers = isset($_POST['selected_engineers']) ? $_POST['selected_engineers'] : [];

//     // Retrieve the schedule_dates array
//     $scheduleDates = isset($_POST['schedule_dates']) ? $_POST['schedule_dates'] : [];

//     // Loop through selected sites and engineers
//     foreach ($selectedSites as $siteId) {
//         foreach ($selectedEngineers as $engineerCode) {
//             // Check if schedule_date is provided for the current site and engineer
//             if (isset($scheduleDates[$siteId][$engineerCode])) {
//                 $scheduleDate = $scheduleDates[$siteId][$engineerCode];

//                 // Insert the data into the many-to-many table (work)
//                 $sql = "INSERT INTO work (site_id, employee_code, schedule_date) VALUES ('$siteId', '$engineerCode', '$scheduleDate')";
//                 mysqli_query($conn, $sql);
//             }
//         }
//     }

//     // Show success message
//     echo "<script>alert('Data has been assigned successfully!');</script>";
// }

if (isset($_POST['assign'])) {
    // Retrieve the selected sites and engineers
    $selectedSites = isset($_POST['selected_sites']) ? $_POST['selected_sites'] : [];
    $selectedEngineers = isset($_POST['selected_engineers']) ? $_POST['selected_engineers'] : [];

    // Retrieve the schedule_dates array
    $scheduleDates = isset($_POST['schedule_dates']) ? $_POST['schedule_dates'] : [];

    // Loop through selected sites and engineers
    foreach ($selectedSites as $siteId) {
        foreach ($selectedEngineers as $engineerCode) {
            // Check if schedule_date is provided for the current site and engineer
            if (isset($scheduleDates[$siteId][$engineerCode])) {
                $scheduleDate = $scheduleDates[$siteId][$engineerCode];

                // Insert the data into the many-to-many table (work)
                $sql = "INSERT INTO work (site_id, employee_code, schedule_date) VALUES ('$siteId', '$engineerCode', '$scheduleDate')";

                // Execute the query
                if (mysqli_query($conn, $sql)) {
                    // Insertion successful
                    echo "<script>alert('Task has been assigned successfully! for Site ID: $siteId and Engineer Code: $engineerCode<br>');</script>";
                    // echo "<script>showSuccessToast('$siteId', '$engineerCode');</script>";
                } else {
                    // Insertion failed
                    echo "Error inserting data for Site ID: $siteId and Engineer Code: $engineerCode: " . mysqli_error($conn) . "<br>";
                }
            }
        }
    }

    // Show success message
    // echo "<script>alert('Task has been assigned successfully!');</script>";
}


?>

                        <button type="button" onclick="addRows()" class="btn btn-primary ml-3 mb-2">Add</button>
                        <button name='assign' class='btn btn-primary ml-3 mb-2'>Assign</button>

                        <div class="row">
                            <div class="col-md-12">
                                <div style='height: 250px;overflow-y:scroll;'>
                                    <table class='table table-bordered table-md'>
                                        <thead class='thead-light'>
                                            <tr>
                                                <th>Site ID</th>
                                                <th>E_Code</th>
                                                <th>Schedule Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="assignmentTable">
                                            <!-- Assigned pairs will be added dynamically here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>

                    <script>
                        function addRows() {
                            var siteTable = document.getElementById("siteTable");
                            var engineerTable = document.getElementById("engineerTable");
                            var assignmentTable = document.getElementById("assignmentTable");

                            var selectedSites = [];
                            var selectedEngineers = [];

                            // Get selected site IDs
                            var siteRows = siteTable.getElementsByTagName("tr");
                            for (var i = 1; i < siteRows.length; i++) {
                                var checkbox = siteRows[i].getElementsByTagName("input")[0];
                                if (checkbox.checked) {
                                    var siteId = siteRows[i].getElementsByTagName("td")[1].innerText;
                                    selectedSites.push(siteId);
                                }
                            }

                            // Get selected engineers
                            var engineerRows = engineerTable.getElementsByTagName("tr");
                            for (var j = 1; j < engineerRows.length; j++) {
                                var checkbox = engineerRows[j].getElementsByTagName("input")[0];
                                if (checkbox.checked) {
                                    var engineerCode = engineerRows[j].getElementsByTagName("td")[1].innerText;
                                    selectedEngineers.push(engineerCode);
                                }
                            }

                            // Add rows to assignment table
                            for (var k = 0; k < selectedSites.length; k++) {
                                for (var l = 0; l < selectedEngineers.length; l++) {
                                    var row = assignmentTable.insertRow();
                                    var siteIdCell = row.insertCell();
                                    var engineerCodeCell = row.insertCell();
                                    var scheduleDateCell = row.insertCell();

                                    siteIdCell.innerHTML = selectedSites[k];
                                    engineerCodeCell.innerHTML = selectedEngineers[l];
                                    scheduleDateCell.innerHTML = "<input type='date' name='schedule_dates[" + selectedSites[k] + "][" + selectedEngineers[l] + "]'>";
                                }
                            }
                        }
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('areaheadfooter.php'); ?>