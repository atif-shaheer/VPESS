<?php include('bdeheader.php'); ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM customer_work WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php
if(isset($_POST['updatecustomerdetail'])) {
    $id = $_POST['id'];
    $work_check = $_POST['work_check'];
    $rate_check = $_POST['rate_check'];
    $state_location = $_POST['state_location'];
    $department_type = $_POST['department_type'];
    $work_order = $_POST['work_order'];
    
    $sql = "UPDATE customer_work SET work_check='$work_check', rate_check='$rate_check',
    state_location='$state_location', department_type='$department_type', work_order='$work_order' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Details updated Successfully!');window.location.href='bdecustomerrpt.php'</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
}
?>

 <div class="main-content" style="min-height: 530px;">
    <section class="section">
        <div class="section-body">
            <div class="row">

                <div id="edit-panel" class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post">
                                <div class="card-header">
                                    <h4>Fill Customer Rest Detail</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div hidden class="form-group col-md-3">
                                            <label>C_id</label>
                                            <input value="<?php echo $row['id']; ?>" id="id" name="id" type="text" class="form-control"
                                                required="" readonly>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Pro Co-ordinator</label>
                                            <input value="<?php echo $row['c_username']; ?>" id="c_username" name="c_username" type="text" class="form-control"
                                                required="" readonly>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Work Check</label>
                                            <select id="work_check" name="work_check" class="form-control">
                                                <option value="<?php echo $row['work_check']; ?>"><?php echo $row['work_check']; ?></option>
                                                <option>approved</option>
                                                <option>unapproved</option>
                                            </select>
                                            <!-- <input name="work_check" value="<?php echo $row['work_check']; ?>" type="text" class="form-control" required=""> -->
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Rate Check</label>
                                            <select id="rate_check" name="rate_check" class="form-control">
                                                <option value="<?php echo $row['rate_check']; ?>"><?php echo $row['rate_check']; ?></option>
                                                <option>approved</option>
                                                <option>unapproved</option>
                                            </select>
                                            <!-- <input name="total_charges" value="<?php echo $row['total_charges']; ?>" type="text" class="form-control" required=""> -->
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Select State Location</label>
                                            <select name="state_location" id="state_location" class="form-control">
                                                <option value=""><?php echo $row['state_location']; ?></option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chandigarh">Chandigarh</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                <option value="Daman and Diu">Daman and Diu</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Lakshadweep">Lakshadweep</option>
                                                <option value="Puducherry">Puducherry</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Select Department Type</label>
                                            <select name="department_type" id="department_type" class="form-control">
                                                <option value=""><?php echo $row['department_type']; ?></option>
                                                <option value="Service Head">Service Head</option>
                                                <option value="Small Project Head">Small Project Head</option>
                                                <option value="Mega Project Head">Mega Project Head</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Select Work Order</label>
                                            <select name="work_order" id="work_order" class="form-control">
                                                <option value="<?php echo $row['work_order']; ?>"><?php echo $row['work_order']; ?></option>
                                                <option value="Pending">Pending</option>
                                                <option value="Receieved">Receieved</option>
                                                <option value="Requested">Requested</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" name="updatecustomerdetail" class="btn btn-primary">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('bdefooter.php'); ?>