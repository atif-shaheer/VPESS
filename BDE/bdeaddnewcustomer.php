<?php include('bdeheader.php'); ?>

<?php
session_start();
if (!isset($_SESSION["c_id"])) {
    // header("Location: bdelogin.php");
    exit();
}

if (isset($_POST['fillcustomercriteria'])) {
    $site_name = $_POST['site_name'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $site_address = $_POST['site_address'];
    $site_id = $_POST['site_id'];
    $state = $_POST['state'];
    $job = $_POST['job'];
    $commercial_rate = $_POST['commercial_rate'];
    $time_frame = $_POST['time_frame'];
    $job_details = $_POST['job_details'];
    $contact_person = $_POST['contact_person'];
    $contact_number = $_POST['contact_number'];
    $c_username = $_POST['c_username'];
    $c_id = $_POST['c_id'];
    // $currentdate = date('Y-m-d');

    $query = "INSERT INTO verify_customer (site_name, company_name, location, site_address, site_id, state, job, commercial_rate, time_frame, job_details, contact_person, contact_number, c_username, c_id) 
        VALUES ('$site_name', '$company_name', '$location', '$site_address', '$site_id', '$state', '$job', '$commercial_rate', '$time_frame', '$job_details', '$contact_person', '$contact_number', '$c_username', '$c_id')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Your Details Added Successfully!');window.location.href='$_SERVER[PHP_SELF]'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
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
                                <h4>Add New Job</h4>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Site Name</label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" aria-describedby="emailHelp" placeholder="Enter Site Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Company Name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" aria-describedby="emailHelp" placeholder="Enter Company Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputEmail1">Site City</label>
                                            <input type="text" class="form-control" id="location" name="location" aria-describedby="emailHelp" placeholder="Enter Site Location">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Site Address</label>
                                            <input type="text" class="form-control" id="site_address" name="site_address" aria-describedby="emailHelp" placeholder="Enter Site Address">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputEmail1">Site Id</label>
                                            <input type="text" class="form-control" id="site_id" name="site_id" aria-describedby="emailHelp" placeholder="Enter Site Id">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Select State Location</label>
                                            <select name="state" class="form-control mb-3">
                                                <option>Select State Location</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <!-- <option value="Telangana">Telangana</option> -->
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Select Job</label>
                                            <select class="form-control mb-3" name="job">
                                                <option>Select</option>
                                                <option value="Installation Work">Installation Work</option>
                                                <option value="Visit">Visit</option>
                                                <option value="Service Work">Service Work</option>
                                                <option value="Site Service Work">Site Service Work</option>
                                                <option value="Dismantling Work+">Dismantling Work+</option>
                                                <option value="Dismantling And Installaton">Dismantling And Installaton</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputEmail1">Comercial Rate</label>
                                            <input type="text" class="form-control" id="commercial_rate" name="commercial_rate" aria-describedby="emailHelp" placeholder="Enter Comercial Rate">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputEmail1">Time Frame</label>
                                            <input type="date" class="form-control" id="time_frame" name="time_frame" aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Job Detail</label>
                                            <input type="text" class="form-control" id="job_details" name="job_details" aria-describedby="emailHelp" placeholder="Enter Job Details">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputEmail1">Contact Person Name</label>
                                            <input type="text" class="form-control" id="contact_person" name="contact_person" aria-describedby="emailHelp" placeholder="Enter Contact Person Name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputEmail1">Contact Number</label>
                                            <input maxlength="10" type="number" class="form-control" id="contact_number" name="contact_number" aria-describedby="emailHelp" placeholder="Enter Contact Number">
                                        </div>
                                        <div hidden class="form-group col-md-3">
                                            <?php
                                            session_start();
                                            if (isset($_SESSION['c_username'])) {
                                                $c_username = $_SESSION['c_username'];
                                            }
                                            ?>
                                            <label for="exampleInputEmail1">Customer Name</label>
                                            <input type="text" class="form-control" id="c_username" name="c_username" value="<?php echo $c_username; ?>" readonly>
                                        </div>
                                        <div hidden class="form-group col-md-3">
                                            <?php
                                            session_start();
                                            if (isset($_SESSION['c_id'])) {
                                                $c_id = $_SESSION['c_id'];
                                            }
                                            ?>
                                            <label for="exampleInputEmail1">Customer I'd</label>
                                            <input type="text" class="form-control" id="c_id" name="c_id" value="<?php echo $c_id; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label for="exampleInputEmail1" style="color:white;">Customer</label>
                                            <button class="form-control" type="submit" name="fillcustomercriteria" class="btn btn-primary" style="background-color:#6777ef;color:white;">ADD</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </form>
                    </div>

                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div style="height: 500px;overflow-y:scroll;">
                                    <?php
                                    $sql = "SELECT * FROM verify_customer WHERE c_id = '$c_id' ORDER BY time_frame ASC";
                                    $result = mysqli_query($conn, $sql);
                                    echo "<table class='table table-bordered table-md'>";
                                    echo "<thead class='thead-light'><tr>";
                                    echo "<th style='text-align:center'>SN</th>";
                                    echo "<th style='text-align:center'>Site Name</th>";
                                    echo "<th style='text-align:center'>Company Name</th>";
                                    echo "<th style='text-align:center'>Site City</th>";
                                    echo "<th style='text-align:center'>Site Address</th>";
                                    echo "<th style='text-align:center'>Site I'd</th>";
                                    echo "<th style='text-align:center'>State</th>";
                                    echo "<th style='text-align:center'>Job Type</th>";
                                    echo "<th style='text-align:center'>Comercial Rate</th>";
                                    echo "<th style='text-align:center'>Job Details</th>";
                                    echo "<th style='text-align:center'>Deadline</th>";
                                    echo "<th style='text-align:center'>Contact Person</th>";
                                    echo "<th style='text-align:center'>Contact Number</th>";
                                    echo "</tr></thead>";
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr onclick='displayData(" . $row['id'] . ")'>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["site_name"] . "</td>";
                                            echo "<td>" . $row["company_name"] . "</td>";
                                            echo "<td>" . $row["location"] . "</td>";
                                            echo "<td>" . $row["site_address"] . "</td>";
                                            echo "<td>" . $row["site_id"] . "</td>";
                                            echo "<td>" . $row["state"] . "</td>";
                                            echo "<td>" . $row["job"] . "</td>";
                                            echo "<td>" . $row["commercial_rate"] . "</td>";
                                            echo "<td>" . $row["job_details"] . "</td>";
                                            echo "<td>" . $row["time_frame"] . "</td>";
                                            echo "<td>" . $row["contact_person"] . "</td>";
                                            echo "<td>" . $row["contact_number"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    echo "</table>";
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<?php include('bdefooter.php'); ?>