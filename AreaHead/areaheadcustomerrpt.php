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
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['area'])){
    $area = $_SESSION['area'];
    echo '<input hidden type="text" name="area" value="' . $area . '" readonly>';
}
?>

<div class="container-fluid" id="container-wrapper">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Report</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="areaheadindex.php">Home</a></li>
            <li class="breadcrumb-item">Customer Report</li>
            <li class="breadcrumb-item active" aria-current="page">Add Engineers</li>
        </ol>
    </div> -->


    

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Report</h6>
                    <div class="col-3 col-md-3 col-sm-3">
                        <form method="post" action="">
                            <!-- <label for="site_id">Search by Site ID:</label> -->
                            <input class="form-control" type="text" name="site_id" id="site_id" onchange="this.form.submit()" placeholder="Search By Site I'd" />
                        </form>
                    </div>
                    <!-- <div class="col-3 col-md-3 col-lg-3">
                        <form method="post">
                            <div class="input-group">
                                <select name="job" id="job" class="form-control">
                                    <option value="">-- Select Job Type --</option>
                                    <option value="Installation Work">Installation Work</option>
                                    <option value="Visit">Visit</option>
                                    <option value="Service Work">Service Work</option>
                                    <option value="Site Service Work">Site Service Work</option>
                                    <option value="Dismantling Work">Dismantling Work</option>
                                    <option value="Dismantling And Installaton">Dismantling And Installation</option>
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>                     -->
                </div>


                <!-- <div class="col-12 col-md-12 col-lg-12">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <select name="job" id="job" class="form-control">
                                    <option value="">-- Select Job Type --</option>
                                    <option value="Installation Work">Installation Work</option>
                                    <option value="Visit">Visit</option>
                                    <option value="Service Work">Service Work</option>
                                    <option value="Site Service Work">Site Service Work</option>
                                    <option value="Dismantling Work">Dismantling Work</option>
                                    <option value="Dismantling And Installaton">Dismantling And Installation</option>
                                </select>
                            </div>
                            <div class="input-group-btn">
                                <button type="submit" name="submit" class="btn btn-primary form-control"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div> -->


                <div class="card-body">
                    <div class="table-responsive">
                        <div style="height: 500px;overflow-y:scroll;">
                            <?php
                            if (isset($_GET['work_check'])) {
                                $id = $_GET['work_check'];
                                $work_check = "unapproved";
                                if ($work_check == "unapproved") {
                                    $sql = "UPDATE customer_work SET work_check='approved' WHERE id='$id'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo "<script>alert('Work Approved successfully!');window.location.href='bdecustomerrpt.php';</script>";
                                    }
                                }
                            }
                            ?>

                            <?php
                            if (isset($_GET['rate_check'])) {
                                $id = $_GET['rate_check'];
                                $rate_check = "unapproved";
                                if ($rate_check == "unapproved") {
                                    $sql = "UPDATE customer_work SET rate_check='approved' WHERE id='$id'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo "<script>alert('Rate Approved successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    }
                                }
                            }
                            ?>

                            <?php

                            // Check if the form is submitted
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Get the selected installation_work value from the form
                                if (isset($_POST['installation_work'])) {
                                    $installation_work = $_POST['installation_work'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET installation_work='$installation_work' WHERE id=$id";
                                
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Installation Work Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }
                                
                                // Get the selected network value from the form
                                if (isset($_POST['network'])) {
                                    $network = $_POST['network'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET network='$network' WHERE id=$id";
                                
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Network Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected network value from the form
                                if (isset($_POST['testing'])) {
                                    $testing = $_POST['testing'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET testing='$testing' WHERE id=$id";
                                
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Testing Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected network value from the form
                                if (isset($_POST['live'])) {
                                    $live = $_POST['live'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET live='$live' WHERE id=$id";
                                
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Live Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['live_date'])) {
                                    $live_date = $_POST['live_date'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET live_date='$live_date' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Live Date Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['live_visit_date'])) {
                                    $live_visit_date = $_POST['live_visit_date'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET live_visit_date='$live_visit_date' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Live Visit Date Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['work_status'])) {
                                    $work_status = $_POST['work_status'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET work_status='$work_status' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Work Status Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }
                            
                                // Get the selected date value from the form
                                if (isset($_POST['remark_w'])) {
                                    $remark_w = $_POST['remark_w'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET remark_w='$remark_w' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Remark W Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }
                                
                                // Get the selected date value from the form
                                if (isset($_POST['local_purchase'])) {
                                    $local_purchase = $_POST['local_purchase'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET local_purchase='$local_purchase' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Local Puchase Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['local_purchase_cost'])) {
                                    $local_purchase_cost = $_POST['local_purchase_cost'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET local_purchase_cost='$local_purchase_cost' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Local Puchase Cost Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['addtition_work_cost'])) {
                                    $addtition_work_cost = $_POST['addtition_work_cost'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET addtition_work_cost='$addtition_work_cost' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Addition Work Cost Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['addtition_work'])) {
                                    $addtition_work = $_POST['addtition_work'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET addtition_work='$addtition_work' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('Addition Work Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }

                                // Get the selected date value from the form
                                if (isset($_POST['ho_report'])) {
                                    $ho_report = $_POST['ho_report'];
                                    $id = $_POST['id'];
                                    $sql = "UPDATE customer_work SET ho_report='$ho_report' WHERE id=$id";

                                    if ($conn->query($sql) === TRUE) {
                                        echo "<script>alert('HO Report Update Successfully!');window.location.href='areaheadcustomerrpt.php';</script>";
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }
                            }
                            ?>

                            <?php
                            if (isset($_POST['job'])) {
                                $job = $_POST['job'];
                            } else {
                                $job = "Installation Work"; // Default value
                            }
                            $hide_columns = array();
                            if ($job == "Visit" || $job == "Service Work" || $job == "Site Service Work" || $job == "Dismantling Work+" || $job == "Dismantling And Installation") {
                                $hide_columns = array("Installation Work", "Network", "Testing", "Live");
                            }
                            $area = $_SESSION['area'];

                            if (isset($_POST['site_id'])) {
                                $site_id = $_POST['site_id'];
                                                        
                            $sql = "SELECT * FROM customer_work WHERE checked = 'checked' AND state_location = '$area' AND site_id = '$site_id'  Order By post_date DESC";
                            $result = mysqli_query($conn, $sql);
                            echo "<table class='table align-items-center table-flush'>";
                            echo "<thead class='thead-light'><tr>";
                            echo "<th style='text-align:center'>SN</th>";
                            echo "<th style='text-align:center'>Edit</th>";
                            echo "<th style='text-align:center'>Assign Task</th>";
                            echo "<th style='text-align:center'>View Task</th>";
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
                            echo "<th style='text-align:center'>Company Name</th>";
                            echo "<th style='text-align:center'>Pro Co-ordinator</th>";
                            // echo "<th style='text-align:center'>Customer Id</th>";
                            // echo "<th style='text-align:center'>Work Check</th>";
                            // echo "<th style='text-align:center'>Rate Check</th>";
                            // echo "<th style='text-align:center'>State Location</th>";
                            // echo "<th style='text-align:center'>Department Type</th>";
                            // echo "<th style='text-align:center'>Other Charges Detail</th>";
                            // echo "<th style='text-align:center'>Total Charges</th>";
                            // echo "<th style='text-align:center'>Work Order</th>";
                            // echo "<th style='text-align:center'>WO No.</th>";

                            // if (!in_array("Installation Work", $hide_columns)) {
                            //     echo "<th style='text-align:center'>Installation Work</th>";
                            // }
                            
                            if (!in_array("Network", $hide_columns)) {
                                echo "<th style='text-align:center'>Network</th>";
                            }
                            if (!in_array("Testing", $hide_columns)) {
                                echo "<th style='text-align:center'>Testing</th>";
                            }
                            if (!in_array("Live", $hide_columns)) {
                                echo "<th style='text-align:center'>Live</th>";
                            }
                            echo "<th style='text-align:center'>Live Date</th>";
                            echo "<th style='text-align:center'>Live Visit Date</th>";
                            // echo "<th style='text-align:center'>Work Status</th>";
                            // echo "<th style='text-align:center'>Remark W</th>";
                            echo "<th style='text-align:center'>Local Purchase</th>";
                            echo "<th style='text-align:center'>Local Purchase Cost</th>";
                            echo "<th style='text-align:center'>Addition Work Cost</th>";
                            echo "<th style='text-align:center'>Addition Work</th>";
                            echo "<th style='text-align:center'>HO Report</th>";
                            echo "<th style='text-align:center'>State Location</th>";
                            // echo "<th style='text-align:center'>Remark HO</th>";
                            // echo "<th style='text-align:center'>Billing Status</th>";
                            // echo "<th style='text-align:center'>Invoice No.</th>";
                            // echo "<th style='text-align:center'>Remark I</th>";
                            // echo "<th style='text-align:center'>Payment Status</th>";
                            // echo "<th style='text-align:center'>GST Payment</th>";
                            // echo "<th style='text-align:center'>GST Payment Amount</th>";                                
                            // echo "<th style='text-align:center'>Month</th>";
                            // echo "<th style='text-align:center'>Year</th>";
                            echo "<th style='text-align:center'>P_Date</th>";
                            echo "<th style='text-align:center'>Status</th>";
                            echo "</tr></thead>";
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['job'] == $job) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        //echo "<td><button class='view-btn' data-id='" . $row['id'] . "'>View</button></td>";
                                        echo "<td> <a class='btn btn-primary' href='updatecustomerdetails.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i></a> </td>";
                                        echo "<td> <a class='btn btn-primary' href='assigntask.php?id=" . $row["id"] . "'><i class='fa fa-tasks' aria-hidden='true'></i></a> </td>";
                                        echo "<td> <a class='btn btn-info' href='taskreport.php?id=" . $row["id"] . "'><i class='fa fa-eye' aria-hidden='true'></i></a> </td>";
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
                                        echo "<td>" . $row["company_name"] . "</td>";
                                        echo "<td>" . $row["c_username"] . "</td>";
                                        // echo "<td>" . $row["c_id"]. "</td>";
                                        // echo "<td>" . $row['work_check'] . "</td>";
                                        // echo "<td>" . $row['rate_check'] . "</td>";
                                        // echo "<td>" . $row['state_location'] . "</td>";
                                        // echo "<td>" . $row["department_type"]. "</td>";
                                        // echo "<td>" . $row["other_charges_detail"]. "</td>";
                                        // echo "<td>" . $row["total_charges"]. "</td>";
                                        // echo "<td>" . $row["work_order"]. "</td>";                                            
                                        // echo "<td>" . $row["wo_no"]. "</td>";

                                        // if (!in_array("Installation Work", $hide_columns)) {
                                        //     // echo "<td onclick='enableDropdown()'>" . $row['installation_work'] . "</td>";

                                        //     echo "<td onclick='enableDropdown(this)'>";
                                        //     echo "<span id='installation_work_" . $row['id'] . "'> " . $row['installation_work'] . " </span>";
                                        //     echo "<form id='form_" . $row['id'] . "' style='display:none' method='post'>";
                                        //     echo "<select name='installation_work' onchange='updateInstallationWork(this)'>";
                                        //     echo "<option value='Site Not Reday' " . ($row['installation_work'] == 'Site Not Reday' ? 'selected' : '') . ">" . $row['installation_work'] . "</option>";
                                        //     echo "<option value='Site Not Reday' " . ($row['installation_work'] == 'Site Not Reday' ? 'selected' : '') . ">Site Not Reday</option>";
                                        //     echo "<option value='Material Undeliverd' " . ($row['installation_work'] == 'Material Undeliverd' ? 'selected' : '') . ">Material Undeliverd</option>";
                                        //     echo "<option value='Cabling Start' " . ($row['installation_work'] == 'Cabling Start' ? 'selected' : '') . ">Cabling Start</option>";
                                        //     echo "<option value='Cabling Done' " . ($row['installation_work'] == 'Cabling Done' ? 'selected' : '') . ">Cabling Done</option>";
                                        //     echo "<option value='Installation Start' " . ($row['installation_work'] == 'Installation Start' ? 'selected' : '') . ">Installation Start</option>";
                                        //     echo "<option value='Installation Done' " . ($row['installation_work'] == 'Installation Done' ? 'selected' : '') . ">Installation Done</option>";
                                        //     echo "<option value='Balanced Material Undelivered' " . ($row['installation_work'] == 'Balanced Material Undelivered' ? 'selected' : '') . ">Balanced Material Undelivered</option>";
                                        //     echo "</select>";
                                        //     echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        //     echo "</form>";
                                        //     echo "</td>";
                                        // }
                                        
                                        if (!in_array("Network", $hide_columns)) {
                                            // echo "<td>" . $row['network'] . "</td>";

                                            echo "<td onclick='enableDropdown(this)'>";
                                            echo "<span id='network_" . $row['id'] . "'>" . $row['network'] . "</span>";
                                            echo "<form id='form_1" . $row['id'] . "' style='display:none' method='post'>";
                                            echo "<select name='network' onchange='updatenewtork(this)'>";
                                            echo "<option value='No' " . ($row['network'] == 'No' ? 'selected' : '') . ">" . $row['network'] . "</option>";
                                            echo "<option value='No' " . ($row['network'] == 'No' ? 'selected' : '') . ">No</option>";
                                            echo "<option value='Completed' " . ($row['network'] == 'Completed' ? 'selected' : '') . ">Completed</option>";
                                            echo "<option value='Issue' " . ($row['network'] == 'Issue' ? 'selected' : '') . ">Issue</option>";
                                            echo "<option value='Hardware' " . ($row['network'] == 'Hardware' ? 'selected' : '') . ">Hardware</option>";
                                            echo "</select>";
                                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                            echo "</form>";
                                            echo "</td>";
                                        }
                                        if (!in_array("Testing", $hide_columns)) {
                                            // echo "<td>" . $row['testing'] . "</td>";

                                            echo "<td onclick='enableDropdown(this)'>";
                                            echo "<span id='testing_" . $row['id'] . "'>" . $row['testing'] . "</span>";
                                            echo "<form id='form_2" . $row['id'] . "' style='display:none' method='post'>";
                                            echo "<select name='testing' onchange='updatetesting(this)'>";
                                            echo "<option value='Pending' " . ($row['testing'] == 'Pending' ? 'selected' : '') . ">" . $row['testing'] . "</option>";
                                            echo "<option value='Pending' " . ($row['testing'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
                                            echo "<option value='Completed' " . ($row['testing'] == 'Completed' ? 'selected' : '') . ">Completed</option>";
                                            echo "<option value='Issue' " . ($row['testing'] == 'Issue' ? 'selected' : '') . ">Issue</option>";
                                            echo "<option value='Ongoing' " . ($row['testing'] == 'Ongoing' ? 'selected' : '') . ">Ongoing</option>";
                                            echo "<option value='Hardware' " . ($row['testing'] == 'Hardware' ? 'selected' : '') . ">Hardware</option>";
                                            echo "</select>";
                                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                            echo "</form>";
                                            echo "</td>";
                                        }
                                        if (!in_array("Live", $hide_columns)) {
                                            // echo "<td>" . $row['live'] . "</td>";

                                            echo "<td onclick='enableDropdown(this)'>";
                                            echo "<span id='live_" . $row['id'] . "'>" . $row['live'] . "</span>";
                                            echo "<form id='form_3" . $row['id'] . "' style='display:none' method='post'>";
                                            echo "<select name='live' onchange='updatelive(this)'>";
                                            echo "<option value='Yes' " . ($row['live'] == 'Yes' ? 'selected' : '') . ">" . $row['live'] . "</option>";
                                            echo "<option value='Yes' " . ($row['live'] == 'Yes' ? 'selected' : '') . ">Yes</option>";
                                            echo "<option value='No' " . ($row['live'] == 'No' ? 'selected' : '') . ">No</option>";
                                            echo "<option value='Issue' " . ($row['live'] == 'Issue' ? 'selected' : '') . ">Issue</option>";
                                            echo "</select>";
                                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                            echo "</form>";
                                            echo "</td>";
                                        }

                                        //echo "<td>" . $row["live_date"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='live_date_" . $row['id'] . "'>" . $row['live_date'] . "</span>";
                                        echo "<form id='form_4" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<input onchange='updatelivedate(this)' type='date' name='live_date' value='" . $row['live_date'] . "'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        // echo "<td>" . $row["live_visit_date"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='live_visit_date_" . $row['id'] . "'>" . $row['live_visit_date'] . "</span>";
                                        echo "<form id='form_4" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<input onchange='updatelivevisitdate(this)' type='date' name='live_visit_date' value='" . $row['live_visit_date'] . "'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        // echo "<td>" . $row["work_status"] . "</td>";

                                        // echo "<td onclick='enableDropdown(this)'>";
                                        // echo "<span id='work_status_" . $row['id'] . "'>" . $row['work_status'] . "</span>";
                                        // echo "<form id='form_5" . $row['id'] . "' style='display:none' method='post'>";
                                        // echo "<select name='work_status' onchange='updateworkstatus(this)'>";
                                        // echo "<option value='Pending' " . ($row['work_status'] == 'Pending' ? 'selected' : '') . ">" . $row['work_status'] . "</option>";
                                        // echo "<option value='Pending' " . ($row['work_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
                                        // echo "<option value='Completed' " . ($row['work_status'] == 'Completed' ? 'selected' : '') . ">Completed</option>";
                                        // echo "<option value='Hardware' " . ($row['work_status'] == 'Hardware' ? 'selected' : '') . ">Hardware</option>";
                                        // echo "<option value='Ongoing' " . ($row['work_status'] == 'Ongoing' ? 'selected' : '') . ">Ongoing</option>";
                                        // echo "</select>";
                                        // echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        // echo "</form>";
                                        // echo "</td>";

                                        // echo "<td>" . $row["remark_w"] . "</td>";

                                        // echo "<td onclick='enableDropdown(this)'>";
                                        // echo "<span id='remark_w_" . $row['id'] . "'>" . $row['remark_w'] . "</span>";
                                        // echo "<form id='form_6" . $row['id'] . "' style='display:none' method='post'>";
                                        // echo "<input onchange='updateremarkw(this)' type='text' name='remark_w' value='" . $row['remark_w'] . "'>";
                                        // echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        // echo "</form>";
                                        // echo "</td>";

                                        // echo "<td>" . $row["local_purchase"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='local_purchase_" . $row['id'] . "'>" . $row['local_purchase'] . "</span>";
                                        echo "<form id='form_7" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<input onchange='updatelocalpurchase(this)' type='text' name='local_purchase' value='" . $row['local_purchase'] . "'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        // echo "<td>" . $row["local_purchase_cost"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='local_purchase_cost_" . $row['id'] . "'>" . $row['local_purchase_cost'] . "</span>";
                                        echo "<form id='form_8" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<input onchange='updatelocalpurchasecost(this)' type='number' name='local_purchase_cost' value='" . $row['local_purchase_cost'] . "'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        // echo "<td>" . $row["addtition_work_cost"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='addtition_work_cost_" . $row['id'] . "'>" . $row['addtition_work_cost'] . "</span>";
                                        echo "<form id='form_9" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<input onchange='updateaddtitionworkcost(this)' type='number' name='addtition_work_cost' value='" . $row['addtition_work_cost'] . "'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        // echo "<td>" . $row["addtition_work"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='addtition_work_" . $row['id'] . "'>" . $row['addtition_work'] . "</span>";
                                        echo "<form id='form_10" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<input onchange='updateaddtitionwork(this)' type='text' name='addtition_work' value='" . $row['addtition_work'] . "'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        // echo "<td>" . $row["ho_report"] . "</td>";

                                        echo "<td onclick='enableDropdown(this)'>";
                                        echo "<span id='ho_report_" . $row['id'] . "'>" . $row['ho_report'] . "</span>";
                                        echo "<form id='form_11" . $row['id'] . "' style='display:none' method='post'>";
                                        echo "<select name='ho_report' onchange='updatehoreport(this)'>";
                                        echo "<option value='Pending Form' " . ($row['ho_report'] == 'Pending Form' ? 'selected' : '') . ">" . $row['ho_report'] . "</option>";
                                        echo "<option value='Pending Form' " . ($row['ho_report'] == 'Pending Form' ? 'selected' : '') . ">Pending Form</option>";
                                        echo "<option value='Submitted' " . ($row['ho_report'] == 'Submitted' ? 'selected' : '') . ">Submitted</option>";
                                        echo "<option value='Not Submitted' " . ($row['ho_report'] == 'Not Submitted' ? 'selected' : '') . ">Not Submitted</option>";
                                        echo "<option value='Received' " . ($row['ho_report'] == 'Received' ? 'selected' : '') . ">Received</option>";
                                        echo "</select>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                        echo "</td>";

                                        echo "<td>" . $row["state_location"] . "</td>";
                                        // echo "<td>" . $row["remark_ho"]. "</td>";
                                        // echo "<td>" . $row["billing_status"]. "</td>";
                                        // echo "<td>" . $row["invoice_no"]. "</td>";
                                        // echo "<td>" . $row["remark_i"]. "</td>";
                                        // echo "<td>" . $row["payment_status"]. "</td>";
                                        // echo "<td>" . $row["gst_payment"]. "</td>";
                                        // echo "<td>" . $row["gst_payment_amount"]. "</td>";                                            
                                        // echo "<td>" . $row["year"]. "</td>";
                                        // echo "<td>" . $row["month"]. "</td>";
                                        echo "<td>" . $row["post_date"] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "0 results";
                            }
                            echo "</table>";
                        }else {
                            echo '<div class="alert alert-info col-md-12 text-black" role="alert">';
                            echo 'No Result Found...! Please Try With Site Id';
                            echo '</div>';
                          }
                            ?>
                            <script>
                                function enableDropdown() {
                                var form = document.getElementById("myForm");
                                form.style.display = "block";
                                }
                            </script>

                            <script>
                                function enableDropdown(td) {
                                    // Hide the span element and show the form element
                                    td.childNodes[0].style.display = 'none';
                                    td.childNodes[1].style.display = 'inline-block';
                                }

                                function updateInstallationWork(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }

                                function updatenewtork(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatetesting(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatelive(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatelivedate(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatelivevisitdate(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updateworkstatus(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updateremarkw(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatelocalpurchase(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatelocalpurchasecost(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updateadditionworkcost(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updateaddtitionwork(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                                function updatehoreport(select) {
                                    // Submit the form when the selection changes
                                    select.parentNode.submit();
                                }
                            </script>
                        </div>
                    </div>

                </div>

                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>

<?php include('areaheadfooter.php'); ?>