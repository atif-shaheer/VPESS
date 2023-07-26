<?php include('serviceheadheader.php'); ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM customer_work WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php
    if(isset($_POST['picktosend'])) {
    $id = $_POST['id'];
    $state_location = $_POST['state_location'];
    $department_type = $_POST['department_type'];
                            
    $sql = "UPDATE customer_work SET state_location='$state_location', department_type='$department_type' WHERE id=$id";
                            
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
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post">
                            <div class="card-header">
                                <h4>Add Service Head</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>State Location</label>
                                        <input value="<?php echo $row['state_location'] ?>" id="state_location" name="state_location"  type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Area</label>
                                        <input id="area" name="area" type="text" class="form-control" required=""
                                            placeholder="Please Enter Area">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Employee Code</label>
                                        <input id="employee_code" name="employee_code" type="text" class="form-control"
                                            required="" maxlength="4" placeholder="Please Enter Employee Code">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Password</label>
                                        <input id="password" name="password" type="password" class="form-control"
                                            required="" placeholder="Please Enter Password">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" name="picktosend" class="btn btn-primary">Send</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
<?php include('serviceheadfooter.php'); ?>