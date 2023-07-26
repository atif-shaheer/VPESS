<?php include('bdeheader.php'); ?>



<?php
$id = $_GET['id'];
$sql = "SELECT * FROM verify_customer WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php
if (isset($_POST['verify'])) {
  $id = $_POST['id'];
  $c_verify = $_POST['c_verify'];

  // Update database
  $sql = "UPDATE verify_customer SET c_verify='$c_verify' WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    //echo "<script>alert('Check-Ins Approved Successfully!');window.location.href='newjobs.php'</script>";
  } else {
        echo "Error updating record: " . mysqli_error($conn);
  }
}
?>

<?php
if (isset($_POST['verify'])) {
    $rand_num = rand(0001, 9999);
    $current_month = date('m');
    $current_year = date('Y');
    $ticket_id = 'VP-' . $current_month . '-' . $current_year . '-' . $rand_num;

    $site_name = $_POST['site_name'];
    $location = $_POST['location'];
    $state = $_POST['state'];
    $site_address = $_POST['site_address'];
    $site_id = $_POST['site_id'];
    $job = $_POST['job'];
    $commercial_rate = $_POST['commercial_rate'];
    $job_details = $_POST['job_details'];
    $time_frame = $_POST['time_frame'];
    $contact_person = $_POST['contact_person'];
    $contact_number = $_POST['contact_number'];
    $c_username = $_POST['c_username'];
    $c_id = $_POST['c_id'];
    $company_name = $_POST['company_name'];
    $c_verify = $_POST['c_verify'];

    $query = "INSERT INTO customer_work (ticket_id, site_name, company_name, location, state, site_address, site_id, job, commercial_rate, job_details, time_frame, contact_person, contact_number, c_username, c_id, c_verify) 
        VALUES ('$ticket_id', '$site_name', '$company_name', '$location', '$state', '$site_address', '$site_id', '$job', '$commercial_rate', '$job_details', '$time_frame', '$contact_person', '$contact_number', '$c_username','$c_id', '$c_verify')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Customer Verified Successfully!');window.location.href='verifyjob.php'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<div class="main-content" style="min-height: 530px;">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post">
                            <div class="card-header">
                                <h4>Verify Your Customer</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div hidden class="form-group col-md-3">
                                        <label>Id</label>
                                        <input value="<?php echo $row['id']; ?>" id="id" name="id" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Site Name</label>
                                        <input value="<?php echo $row['site_name']; ?>" id="site_name" name="site_name" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Company Name</label>
                                        <input value="<?php echo $row['company_name']; ?>" id="company_name" name="company_name" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Location</label>
                                        <input value="<?php echo $row['location']; ?>" id="location" name="location" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>State</label>
                                        <input value="<?php echo $row['state']; ?>" id="state" name="state" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Site Address</label>
                                        <input value="<?php echo $row['site_address']; ?>" id="site_address" name="site_address" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Site Id</label>
                                        <input value="<?php echo $row['site_id']; ?>" id="site_id" name="site_id" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Job Type</label>
                                        <input value="<?php echo $row['job']; ?>" id="job" name="job" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Commercial Rate</label>
                                        <input value="<?php echo $row['commercial_rate']; ?>" id="commercial_rate" name="commercial_rate" type="text" class="form-control mb-3" required="">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Time Frame</label>
                                        <input value="<?php echo $row['time_frame']; ?>" id="time_frame" name="time_frame" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Contact Person</label>
                                        <input value="<?php echo $row['contact_person']; ?>" id="contact_person" name="contact_person" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Contact Number</label>
                                        <input value="<?php echo $row['contact_number']; ?>" id="contact_number" name="contact_number" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Job Details</label>
                                        <input value="<?php echo $row['job_details']; ?>" id="job_details" name="job_details" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="c_verify">Verify</label>
                                        <select class="form-control mb-3" id="c_verify" name="c_verify" required>
                                            <option value="unverified" <?php if ($row['c_verify'] == "unverified") echo "selected"; ?>><?php echo $row['c_verify'] ?></option>
                                            <option value="unverified" <?php if ($row['c_verify'] == "unverified") echo "selected"; ?>>unverified</option>
                                            <option value="verified" <?php if ($row['c_verify'] == "verified") echo "selected"; ?>>verified</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>C_Username</label>
                                        <input value="<?php echo $row['c_username']; ?>" id="c_username" name="c_username" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>C_Id</label>
                                        <input value="<?php echo $row['c_id']; ?>" id="c_id" name="c_id" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label style="color:white;">C_Id...........</label>
                                        <button type="submit" name="verify" class="btn btn-primary">Verify</button>
                                    </div>
                                </div>
                            </div>
                                <!-- <div class="card-footer text-right">
                                    <button type="submit" name="addcustomer" class="btn btn-primary">Verify</button>
                                </div> -->
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
</div>
<?php include('bdefooter.php'); ?>