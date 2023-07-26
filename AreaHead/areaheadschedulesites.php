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
                    <h6 class="m-0 font-weight-bold text-primary">Schedule Site Report</h6>
                    <div class="col-md-3">
                        <form method="post" class="input-group">
                            <input type="text" id="searchInput" name="search_input" class="form-control" placeholder="Search By Employee Code">
                            <div class="input-group-append">
                                <button type="submit" name="search_button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div style='height: 450px;overflow-y:scroll;'>
                <div class="table-responsive">
                    <?php
                    $searchInput = isset($_POST['search_input']) ? $_POST['search_input'] : '';

                    $sql = "SELECT * FROM work";

                    if (!empty($searchInput)) {
                        $sql .= " WHERE employee_code = '$searchInput'";
                    }

                    $sql .= " ORDER BY schedule_date ASC limit 20";

                    $result = mysqli_query($conn, $sql);
                    ?>

                    <table class='table table-bordered table-md'>
                        <thead class='thead-light'>
                            <tr>
                                <th>Site ID</th>
                                <th>Engineer Code</th>
                                <th>Schedule Date</th>
                                <th>Assign To Other</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if there are any rows in the result set
                            if (mysqli_num_rows($result) > 0) {
                                // Loop through each row in the result set
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['site_id'] . "</td>";
                                    echo "<td>" . $row['employee_code'] . "</td>";
                                    echo "<td>" . $row['schedule_date'] . "</td>";
                                    echo "<td><a href='updatework.php?employee_code=" . $row['employee_code'] . "&site_id=" . $row['site_id'] . "&schedule_date=" . $row['schedule_date'] . "' class='btn btn-info btn-sm'><i class='fa fa-edit text-white'></i></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                // No rows found in the result set
                                echo "<tr><td colspan='4'>No data available</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
                </div>

                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>

<?php include('areaheadfooter.php'); ?>