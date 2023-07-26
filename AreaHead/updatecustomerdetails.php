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
$id = $_GET['id'];
$sql = "SELECT * FROM customer_work WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php
if (isset($_POST['updatecustomerdetail'])) {
    $id = $_POST['id'];
    $network = $_POST['network'];
    $testing = $_POST['testing'];
    $live = $_POST['live'];
    $live_date = $_POST['live_date'];
    $live_visit_date = $_POST['live_visit_date'];
    $local_purchase = $_POST['local_purchase'];
    $local_purchase_cost = $_POST['local_purchase_cost'];
    $addtition_work_cost = $_POST['addtition_work_cost'];
    $addtition_work = $_POST['addtition_work'];
    $ho_report = $_POST['ho_report'];

    $sql = "UPDATE customer_work SET network = '$network', testing = '$testing', live = '$live', live_date = '$live_date', 
    live_visit_date = '$live_visit_date', local_purchase = '$local_purchase', local_purchase_cost = '$local_purchase_cost', 
    addtition_work_cost = '$addtition_work_cost', addtition_work = '$addtition_work', ho_report = '$ho_report' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Details updated Successfully!');window.location.href='areaheadcustomerrpt.php'</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<div class="container-fluid" id="container-wrapper">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Customer Report</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="areaheadindex.php">Home</a></li>
            <li class="breadcrumb-item">Customer Report</li>
            <li class="breadcrumb-item active" aria-current="page">Update Customer Report</li>
        </ol>
    </div> -->

    <div class="row">
        <div class="col-lg-12">


            <?php

            // // check if the form is submitted
            // if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //     // check if the remark field is set
            //     if (isset($_POST['remark_w'])) {

            //         // get the remark value and the id
            //         $remark_w = $_POST['remark_w'];
            //         $id = $_POST['id'];

            //         // update the remark in the database
            //         $sql = "UPDATE customer_work SET remark_w='$remark_w' WHERE id=$id";
            //         if ($conn->query($sql) === TRUE) {
            //             echo "Remark updated successfully";
            //         } else {
            //             echo "Error updating record: " . mysqli_error($conn);
            //         }
            //     }
            // }
            ?>

            <!-- HTML form with the live visit date and remark fields -->
            <!-- <form method="post">
    <label>Remark:</label>
    <input type="text" name="remark_w" onkeydown="if (event.keyCode == 13) this.form.submit();" value="<?php echo $row['remark_w']; ?>" >
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
</form> -->


            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update Customer Report</h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div hidden class="form-group col-md-3">
                                <label>C_id</label>
                                <input value="<?php echo $row['id']; ?>" id="id" name="id" type="text" class="form-control" required="" readonly>
                            </div>
                            <!-- <div class="form-group col-md-3">
                                <label for="installation_work">Installation Work</label>
                                <select class="form-control mb-3" id="installation_work" name="installation_work"">
                                    <option value="Site Not Reday" <?php if ($row['installation_work'] == "Site Not Reday") echo "selected"; ?>><?php echo $row['installation_work'] ?></option>
                                    <option value="Site Not Reday" <?php if ($row['installation_work'] == "Site Not Reday") echo "selected"; ?>>Site Not Reday</option>
                                    <option value="Material Undeliverd" <?php if ($row['installation_work'] == "Material Undeliverd") echo "selected"; ?>>Material Undeliverd</option>
                                    <option value="Cabling Start" <?php if ($row['installation_work'] == "Cabling Start") echo "selected"; ?>>Cabling Start</option>
                                    <option value="Cabling Done" <?php if ($row['installation_work'] == "Cabling Done") echo "selected"; ?>>Cabling Done</option>
                                    <option value="Installation Start" <?php if ($row['installation_work'] == "Installation Start") echo "selected"; ?>>Installation Start</option>
                                    <option value="Installation Done" <?php if ($row['installation_work'] == "Installation Done") echo "selected"; ?>>Installation Done</option>
                                    <option value="Balanced Material Undelivered" <?php if ($row['installation_work'] == "Balanced Material Undelivered") echo "selected"; ?>>Balanced Material Undelivered</option>
                                </select>
                            </div> -->
                            <div class="form-group col-md-2">
                                <label for="network">Network</label>
                                <select class="form-control mb-3" id="network" name="network">
                                    <option value="No" <?php if ($row['network'] == "No") echo "selected"; ?>><?php echo $row['network'] ?></option>
                                    <option value="No" <?php if ($row['network'] == "No") echo "selected"; ?>>No</option>
                                    <option value="Completed" <?php if ($row['network'] == "Completed") echo "selected"; ?>>Completed</option>
                                    <option value="Issue" <?php if ($row['network'] == "Issue") echo "selected"; ?>>Issue</option>
                                    <option value="Hardware" <?php if ($row['network'] == "Hardware") echo "selected"; ?>>Hardware</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="testing">Testing</label>
                                <select class="form-control mb-3" id="testing" name="testing">
                                    <option value="Pending" <?php if ($row['testing'] == "Pending") echo "selected"; ?>><?php echo $row['testing'] ?></option>
                                    <option value="Pending" <?php if ($row['testing'] == "Pending") echo "selected"; ?>>Pending</option>
                                    <option value="Completed" <?php if ($row['testing'] == "Completed") echo "selected"; ?>>Completed</option>
                                    <option value="Issue" <?php if ($row['testing'] == "Issue") echo "selected"; ?>>Issue</option>
                                    <option value="Hardware" <?php if ($row['testing'] == "Hardware") echo "selected"; ?>>Hardware</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="live">Live</label>
                                <select class="form-control mb-3" id="live" name="live">
                                    <option value="Yes" <?php if ($row['live'] == "Yes") echo "selected"; ?>><?php echo $row['live'] ?></option>
                                    <option value="Yes" <?php if ($row['live'] == "Yes") echo "selected"; ?>>Yes</option>
                                    <option value="No" <?php if ($row['live'] == "No") echo "selected"; ?>>No</option>
                                    <option value="Issue" <?php if ($row['live'] == "Issue") echo "selected"; ?>>Issue</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="live_date">Live Date</label>
                                <input type="date" class="form-control" id="live_date" name="live_date" aria-describedby="live_date" value="<?php echo $row['live_date'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="live_visit_date">Live Visit Date</label>
                                <input type="date" class="form-control" id="live_visit_date" name="live_visit_date" aria-describedby="live_visit_date" value="<?php echo $row['live_visit_date'] ?>">
                            </div>
                            <!-- <div class="form-group col-md-2">
                                <label for="work_status">Work Status</label>
                                <select class="form-control mb-3" id="work_status" name="work_status">
                                    <option value="Pending" <?php if ($row['work_status'] == "Pending") echo "selected"; ?>><?php echo $row['work_status'] ?></option>
                                    <option value="Pending" <?php if ($row['work_status'] == "Pending") echo "selected"; ?>>Pending</option>
                                    <option value="Completed" <?php if ($row['work_status'] == "Completed") echo "selected"; ?>>Completed</option>
                                    <option value="Hardware" <?php if ($row['work_status'] == "Hardware") echo "selected"; ?>>Hardware</option>
                                    <option value="Ongoing" <?php if ($row['work_status'] == "Ongoing") echo "selected"; ?>>Ongoing</option>
                                </select>
                            </div> -->
                            <!-- <div class="form-group col-md-2">
                                <label for="remark_w">Remark W</label>
                                <input type="text" class="form-control" id="remark_w" name="remark_w" aria-describedby="remark_w" value="<?php echo $row['remark_w'] ?>">
                            </div> -->
                            <div class="form-group col-md-3">
                                <label for="local_purchase">Local Purchase</label>
                                <input type="text" class="form-control" id="local_purchase" name="local_purchase" aria-describedby="local_purchase" value="<?php echo $row['local_purchase'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="local_purchase_cost">Local Purchase Cost</label>
                                <input type="text" class="form-control" id="local_purchase_cost" name="local_purchase_cost" aria-describedby="local_purchase_cost" value="<?php echo $row['local_purchase_cost'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="addtition_work_cost">Addtition Work Cost</label>
                                <input type="text" class="form-control" id="addtition_work_cost" name="addtition_work_cost" aria-describedby="addtition_work_cost" value="<?php echo $row['addtition_work_cost'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="addtition_work">Addtition Work</label>
                                <input type="text" class="form-control" id="addtition_work" name="addtition_work" aria-describedby="addtition_work" value="<?php echo $row['addtition_work'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="ho_report">Ho Report</label>
                                <select class="form-control mb-3" id="ho_report" name="ho_report">
                                    <option value="Pending Form" <?php if ($row['ho_report'] == "Pending Form") echo "selected"; ?>><?php echo $row['ho_report'] ?></option>
                                    <option value="Pending Form" <?php if ($row['ho_report'] == "Pending Form") echo "selected"; ?>>Pending Form</option>
                                    <option value="Submitted" <?php if ($row['ho_report'] == "Submitted") echo "selected"; ?>>Submitted</option>
                                    <option value="Not Submitted" <?php if ($row['ho_report'] == "Not Submitted") echo "selected"; ?>>Not Submitted</option>
                                    <option value="Received" <?php if ($row['ho_report'] == "Received") echo "selected"; ?>>Received</option>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="ho_report" style="color:white;">Ho Report</label>
                                <button class="form-control" type="submit" name="updatecustomerdetail" class="btn btn-primary" style="background-color:#6777ef;color:white;">ADD</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('areaheadfooter.php'); ?>