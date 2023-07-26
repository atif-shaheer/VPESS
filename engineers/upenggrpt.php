<?php include('engineersheader.php'); ?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}
?>

<?php
$employee_code = $_GET['employee_code'];
$sql = "SELECT * FROM engineers WHERE employee_code = $employee_code";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>


<?php
if (isset($_POST['updateenggdetail'])) {
    //$employee_code = $_POST['employee_code'];
    $installation_work = $_POST['installation_work'];
    $remark_w = $_POST['remark_w'];
    $work_status = $_POST['work_status'];
    $report_format_pdf = '';
    // $fileType = strtolower(pathinfo($report_format_pdf,PATHINFO_EXTENSION));

    // if($fileType != "pdf") {
    //     echo "Only PDF files are allowed.";
    //     exit;
    // }
    
    // Check if report_format field was submitted
    if(isset($_FILES['report_format']) && $_FILES['report_format']['error'][0] !== UPLOAD_ERR_NO_FILE) {
        $uploadFolder = '../uploadfiles/';
        $report_formats = array();
        foreach ($_FILES['report_format']['tmp_name'] as $key => $image) {
            $imageTmpName = $_FILES['report_format']['tmp_name'][$key];
            $report_format = $_FILES['report_format']['name'][$key];
            $result = move_uploaded_file($imageTmpName,$uploadFolder.$report_format);
            $report_formats[] = $report_format;
        }
        $report_format_str = implode(",", $report_formats);
    } else {
        $report_format_str = "";
    }

    if(isset($_FILES["report_format_pdf"]["name"]) && !empty($_FILES["report_format_pdf"]["name"])) {
        $target_dir = "../uploadfiles/";
        $target_file = $target_dir . basename($_FILES["report_format_pdf"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if file is a PDF
        if($fileType != "pdf") {
            echo "<script>alert('Only PDF File Accepted..!');window.location.href='workboard.php'</script>";
            exit;
        }
        
        // Upload the file
        if (move_uploaded_file($_FILES["report_format_pdf"]["tmp_name"], $target_file)) {
            $report_format_pdf = basename($_FILES["report_format_pdf"]["name"]);
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file..!');window.location.href='workboard.php'</script>";
            exit;
        }
    }


    // $sql = "UPDATE engineers as e JOIN customer_work as c ON e.site_id = c.site_id SET e.installation_work = '$installation_work', 
    //         e.remark_w = '$remark_w', e.report_format = '$report_format_str', e.report_format_pdf = '$report_format_pdf', e.work_status = '$work_status',
    //         c.work_status = '$work_status' WHERE e.employee_code = $employee_code";

    $sql = "UPDATE engineers SET installation_work = '$installation_work', remark_w = '$remark_w', report_format = '$report_format_str',
        work_status = '$work_status', report_format_pdf = '$report_format_pdf' WHERE employee_code = $employee_code";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Details updated Successfully!');window.location.href='workboard.php'</script>";
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
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- <div hidden class="form-group col-md-3">
                                <label>C_id</label>
                                <input value="<?php echo $row['employee_code']; ?>" id="employee_code" name="employee_code" type="text" class="form-control" required="" readonly>
                            </div> -->
                            <div class="form-group col-md-2">
                                <label for="work_status">Work Status</label>
                                <select class="form-control mb-3" id="work_status" name="work_status"">
                                    <option value="Ongoing" <?php if ($row['work_status'] == "Ongoing") echo "selected"; ?>><?php echo $row['work_status'] ?></option>
                                    <option value="Ongoing" <?php if ($row['work_status'] == "Ongoing") echo "selected"; ?>>Ongoing</option>
                                    <option value="Completed" <?php if ($row['work_status'] == "Completed") echo "selected"; ?>>Completed</option>
                                    <option value="Hardware" <?php if ($row['work_status'] == "Hardware") echo "selected"; ?>>Hardware</option>
                                    <option value="Client Dependency" <?php if ($row['work_status'] == "Client Dependency") echo "selected"; ?>>Client Dependency</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="installation_work">Installation Work</label>
                                <select class="form-control mb-3" id="installation_work" name="installation_work"">
                                    <option value="Site Not Ready" <?php if ($row['installation_work'] == "Site Not Ready") echo "selected"; ?>><?php echo $row['installation_work'] ?></option>
                                    <option value="Site Not Ready" <?php if ($row['installation_work'] == "Site Not Ready") echo "selected"; ?>>Site Not Ready</option>
                                    <option value="Material Undeliverd" <?php if ($row['installation_work'] == "Material Undeliverd") echo "selected"; ?>>Material Undeliverd</option>
                                    <option value="Cabling Start" <?php if ($row['installation_work'] == "Cabling Start") echo "selected"; ?>>Cabling Start</option>
                                    <option value="Cabling Done" <?php if ($row['installation_work'] == "Cabling Done") echo "selected"; ?>>Cabling Done</option>
                                    <option value="Installation Start" <?php if ($row['installation_work'] == "Installation Start") echo "selected"; ?>>Installation Start</option>
                                    <option value="Installation Done" <?php if ($row['installation_work'] == "Installation Done") echo "selected"; ?>>Installation Done</option>
                                    <option value="Balanced Material Undelivered" <?php if ($row['installation_work'] == "Balanced Material Undelivered") echo "selected"; ?>>Balanced Material Undelivered</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="remark_w">Remark W</label>
                                <input type="text" class="form-control" id="remark_w" name="remark_w" aria-describedby="remark_w" value="<?php echo $row['remark_w'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="report_format">Report Format</label>
                                <input multiple type="file" class="form-control" id="report_format" name="report_format[]" aria-describedby="report_format" value="<?php echo $row['report_format'] ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="report_format_pdf">Report Format PDF</label>
                                <input multiple type="file" class="form-control" id="report_format_pdf" name="report_format_pdf" aria-describedby="report_format_pdf" value="<?php echo $row['report_format_pdf'] ?>">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="ho_report" style="color:white;">Ho Report</label>
                                <button class="form-control" type="submit" name="updateenggdetail" class="btn btn-primary" style="background-color:#6777ef;color:white;">ADD</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('engineersfooter.php'); ?>