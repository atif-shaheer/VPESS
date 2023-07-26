<?php include('bdeheader.php'); ?>



<?php
$id = $_GET['id'];
$sql = "SELECT * FROM customer_work WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php
if (isset($_POST['approve'])) {
  $id = $_POST['id'];
  $work_order = $_POST['work_order'];
  $work_check = $_POST['work_check'];
  $rate_check = $_POST['rate_check'];

  // Update database
  $sql = "UPDATE customer_work SET work_order='$work_order', work_check='$work_check', rate_check='$rate_check' WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Check-Ins Approved Successfully!');window.location.href='newjobs.php'</script>";
  } else {
        echo "Error updating record: " . mysqli_error($conn);
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
                                <h4>Approve Check-Ins</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div hidden class="form-group col-md-3">
                                        <label>Id</label>
                                        <input value="<?php echo $row['id']; ?>" id="id" name="id" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="work_order">Work Order</label>
                                        <select class="form-control mb-3" id="work_order" name="work_order">
                                            <option value="Pending" <?php if ($row['work_order'] == "Pending") echo "selected"; ?>><?php echo $row['work_order'] ?></option>
                                            <option value="Pending" <?php if ($row['work_order'] == "Pending") echo "selected"; ?>>Peding</option>
                                            <option value="Received" <?php if ($row['work_order'] == "Received") echo "selected"; ?>>Received</option>
                                            <option value="Requested" <?php if ($row['work_order'] == "Requested") echo "selected"; ?>>Requested</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Work Check</label>
                                        <select class="form-control mb-3" id="work_check" name="work_check">
                                            <option value="unapproved" <?php if ($row['work_check'] == "unapproved") echo "selected"; ?>><?php echo $row['work_check'] ?></option>
                                            <option value="unapproved" <?php if ($row['work_check'] == "unapproved") echo "selected"; ?>>unapproved</option>
                                            <option value="approved" <?php if ($row['work_check'] == "approved") echo "selected"; ?>>approved</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Rate Check</label>
                                        <select class="form-control mb-3" id="rate_check" name="rate_check">
                                            <option value="unapproved" <?php if ($row['rate_check'] == "unapproved") echo "selected"; ?>><?php echo $row['rate_check'] ?></option>
                                            <option value="unapproved" <?php if ($row['rate_check'] == "unapproved") echo "selected"; ?>>unapproved</option>
                                            <option value="approved" <?php if ($row['rate_check'] == "approved") echo "selected"; ?>>approved</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group col-md-2">
                                        <label>C_Username</label>
                                        <input value="<?php echo $row['c_username']; ?>" id="c_username" name="c_username" type="text" class="form-control mb-3" required="" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>C_Id</label>
                                        <input value="<?php echo $row['c_id']; ?>" id="c_id" name="c_id" type="text" class="form-control mb-3" required="" readonly>
                                    </div> -->
                                    <div class="form-group col-md-1">
                                        <label style="color:white;">C_Id...........</label>
                                        <button type="submit" name="approve" class="btn btn-primary">Approve</button>
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