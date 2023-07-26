<?php include('customerheader.php'); ?>
<?php
session_start();
if (!isset($_SESSION["c_id"])) {
    header("Location: customerlogin.php");
    exit();
}
?>

<?php
session_start();
if (!isset($_SESSION["c_id"])) {
    header("Location: customerlogin.php");
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


<div class="container-fluid" id="container-wrapper">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Fill Company Criteria</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="customerindex.php">Home</a></li>
            <li class="breadcrumb-item">Engineer</li>
            <li class="breadcrumb-item active" aria-current="page">Fill Company Criteria</li>
        </ol>
    </div> -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Add New Job</h5>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name"
                                    aria-describedby="emailHelp" placeholder="Enter Site Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    aria-describedby="emailHelp" placeholder="Enter Company Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Site City</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    aria-describedby="emailHelp" placeholder="Enter Site Location">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Site Address</label>
                                <input type="text" class="form-control" id="site_address" name="site_address"
                                    aria-describedby="emailHelp" placeholder="Enter Site Address">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Site Id</label>
                                <input type="text" class="form-control" id="site_id" name="site_id"
                                    aria-describedby="emailHelp" placeholder="Enter Site Id">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Select State Location</label>
                                <select name="state" class="form-control mb-3" >
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
                                <input type="text" class="form-control" id="commercial_rate" name="commercial_rate"
                                    aria-describedby="emailHelp" placeholder="Enter Comercial Rate">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Time Frame</label>
                                <input type="date" class="form-control" id="time_frame" name="time_frame"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Job Detail</label>
                                <input type="text" class="form-control" id="job_details" name="job_details"
                                    aria-describedby="emailHelp" placeholder="Enter Job Details">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Contact Person Name</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person"
                                    aria-describedby="emailHelp" placeholder="Enter Contact Person Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Contact Number</label>
                                <input maxlength="10" type="number" class="form-control" id="contact_number" name="contact_number"
                                    aria-describedby="emailHelp" placeholder="Enter Contact Number">
                            </div>
                            <div hidden class="form-group col-md-3">
                                <?php
                                session_start();
                                if (isset($_SESSION['c_username'])) {
                                    $c_username = $_SESSION['c_username'];
                                }
                                ?>
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" class="form-control" id="c_username" name="c_username"
                                    value="<?php echo $c_username; ?>" readonly>
                            </div>
                            <div hidden class="form-group col-md-3">
                                <?php
                                session_start();
                                if (isset($_SESSION['c_id'])) {
                                    $c_id = $_SESSION['c_id'];
                                }
                                ?>
                                <label for="exampleInputEmail1">Customer I'd</label>
                                <input type="text" class="form-control" id="c_id" name="c_id"
                                    value="<?php echo $c_id; ?>" readonly>
                            </div>
                            <div class="form-group col-md-1">
                            <label for="exampleInputEmail1" style="color:white;">Customer</label>
                                <button class="form-control" type="submit" name="fillcustomercriteria" class="btn btn-primary"
                                    style="background-color:#6777ef;color:white;">ADD</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">All Report</h5>
                    <!-- <div>
                        <h6 class="m-0 font-weight-bold text-danger">
                            <?php
                            // if(isset($_POST['submit'])) {
                            //     $job = $_POST['job'];
                            //     $sql = "SELECT COUNT(*) as count FROM customer_work WHERE job='$job' AND c_id = '$c_id'";
                            //     $result = $conn->query($sql);
                            //     if ($result->num_rows > 0) {
                            //     while($row = $result->fetch_assoc()) {
                            //         echo "Toltal $job: " . $row["count"];
                            //     }
                            //     } else {
                            //     echo "0 results";
                            //     }
                            // }
                            ?>
                        </h6>
                    </div>
                    <div class="col-3 col-md-3 col-lg-3">
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
                    </div>   -->
                </div>
                <div class="table-responsive">
                    <div style="height: 500px;overflow-y:scroll;">
                            <?php
                                // if (isset($_POST['job'])) {
                                //     $job = $_POST['job'];
                                // } else {
                                //     $job = "Installation Work"; // Default value
                                // }
                                // $hide_columns = array();
                                // if ($job == "Visit" || $job == "Service Work" || $job == "Site Service Work" || $job == "Dismantling Work+" || $job == "Dismantling And Installation") {
                                //     $hide_columns = array("Installation Work", "Network", "Testing", "Live");
                                // }
                                $sql = "SELECT * FROM verify_customer WHERE c_id = '$c_id' ORDER BY time_frame ASC";
                                $result = mysqli_query($conn, $sql);
                                echo "<table class='table table-bordered table-md'>";
                                echo "<thead class='thead-light'><tr>";
                                echo "<th style='text-align:center'>SN</th>";
                                //echo "<th style='text-align:center'>Edit</th>";
                                //echo "<th style='text-align:center'>Ticket I'd</th>";
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
                                // echo "<th style='text-align:center'>Report Format</th>";

                                // echo "<th style='text-align:center'>Company Name</th>";
                                // echo "<th style='text-align:center'>Pro Co-ordinator</th>";
                                // echo "<th style='text-align:center'>Customer Id</th>";
                                // echo "<th style='text-align:center'>Work Check</th>";
                                // echo "<th style='text-align:center'>Rate Check</th>";
                                // echo "<th style='text-align:center'>State Location</th>";
                                // echo "<th style='text-align:center'>Department Type</th>";
                                // if (!in_array("Live", $hide_columns)) {
                                //     echo "<th style='text-align:center'>Live</th>";
                                // }
                                // echo "<th style='text-align:center'>Live Date</th>";
                                // echo "<th style='text-align:center'>Live Visit Date</th>";
                                // echo "<th style='text-align:center'>Work Status</th>";
                                // echo "<th style='text-align:center'>Remark W</th>";
                                // echo "<th style='text-align:center'>Local Purchase</th>";
                                // echo "<th style='text-align:center'>Local Purchase Cost</th>";
                                // echo "<th style='text-align:center'>Addition Work Cost</th>";
                                // echo "<th style='text-align:center'>Addition Work</th>";
                                // echo "<th style='text-align:center'>Total Charges</th>";
                                // echo "<th style='text-align:center'>HO Report</th>";
                                // echo "<th style='text-align:center'>Work Order</th>";
                                // echo "<th style='text-align:center'>Reminder</th>";
                                // echo "<th style='text-align:center'>Other Charges Detail</th>";
                                // echo "<th style='text-align:center'>WO No.</th>";                                
                                // if (!in_array("Installation Work", $hide_columns)) {
                                //     echo "<th style='text-align:center'>Installation Work</th>";
                                // }
                                // if (!in_array("Network", $hide_columns)) {
                                //     echo "<th style='text-align:center'>Network</th>";
                                // }
                                // if (!in_array("Testing", $hide_columns)) {
                                //     echo "<th style='text-align:center'>Testing</th>";
                                // }

                                // echo "<th style='text-align:center'>Remark HO</th>";
                                // echo "<th style='text-align:center'>Billing Status</th>";
                                // echo "<th style='text-align:center'>Invoice No.</th>";
                                // echo "<th style='text-align:center'>Remark I</th>";
                                // echo "<th style='text-align:center'>Payment Status</th>";
                                // echo "<th style='text-align:center'>GST Payment</th>";
                                // echo "<th style='text-align:center'>GST Payment Amount</th>";                                
                                // echo "<th style='text-align:center'>Month</th>";
                                // echo "<th style='text-align:center'>Year</th>";onclick='enablePanel2(" . $row['id'] . ");''
                                //data-toggle='modal' data-target='.bd-example-modal-lg' data-id='" . $row["id"] . "' class='edit-btn'
                                // echo "<th style='text-align:center'>P_Date</th>";
                                // echo "<th style='text-align:center'>Status</th>";
                                echo "</tr></thead>";
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        //if ($row['job'] == $job) {
                                            echo "<tr onclick='displayData(" . $row['id'] . ")'>"; 
                                            echo "<td>" . $row["id"] . "</td>";
                                            //echo "<td> <a class='btn btn-primary' href='updatecustomerdetails.php?id=". $row['id'] ."'><i class='fas fa-edit'></i></a> </td>";
                                            //echo "<td>" . $row["ticket_id"] . "</td>";
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
                                            // echo "<td>". $row["report_format"]. "</td>";
                                            
                                            //echo "<td>" . $row["company_name"] . "</td>";
                                            // echo "<td>" . $row["c_username"] . "</td>";
                                            // echo "<td>" . $row["c_id"] . "</td>";
                                            // echo "<td><a href='bdecustomerrpt.php?work_check=" . $row['id'] . " '>" . $row['work_check'] . "</a></td>";
                                            // echo "<td><a href='bdecustomerrpt.php?rate_check=" . $row['id'] . " '>" . $row['rate_check'] . "</a></td>";
                                            // echo "<td><a href='updateSD.php?id=" . $row["id"] . "'>" . $row['state_location'] . "</a></td>";
                                            // echo "<td><a href='updateSD.php?id=" . $row["id"] . "'>" . $row["department_type"] . "</a></td>";
                                            // echo "<td>" . $row['work_check'] . "</td>";
                                            // echo "<td>" . $row['rate_check'] . "</td>";
                                            // echo "<td>" . $row['state_location'] . "</td>";
                                            // echo "<td>" . $row["department_type"] . "</td>";
                                            // if (!in_array("Live", $hide_columns)) {
                                            //     echo "<td>" . $row['live'] . "</td>";
                                            // }
                                            // echo "<td>" . $row["live_date"] . "</td>";
                                            // echo "<td>" . $row["live_visit_date"] . "</td>";
                                            // echo "<td>" . $row["work_status"] . "</td>";
                                            // echo "<td>" . $row["remark_w"] . "</td>";
                                            // echo "<td>" . $row["local_purchase"] . "</td>";
                                            // echo "<td>" . $row["local_purchase_cost"] . "</td>";
                                            // echo "<td>" . $row["addtition_work_cost"] . "</td>";
                                            // echo "<td>" . $row["addtition_work"] . "</td>";
                                            // echo "<td>" . $row["total_charges"] . "</td>";
                                            // echo "<td>" . $row["ho_report"] . "</td>";
                                            // echo "<td>" . $row["work_order"] . "</td>";
                                            // echo "<td>Now Nothing</td>";
                                            // echo "<td>" . $row["other_charges_detail"]. "</td>";
                                            // echo "<td>" . $row["wo_no"]. "</td>";
                                            // if (!in_array("Installation Work", $hide_columns)) {
                                            //     echo "<td>" . $row['installation_work'] . "</td>";
                                            // }
                                            // if (!in_array("Network", $hide_columns)) {
                                            //     echo "<td>" . $row['network'] . "</td>";
                                            // }
                                            // if (!in_array("Testing", $hide_columns)) {
                                            //     echo "<td>" . $row['testing'] . "</td>";
                                            // }
                                            // echo "<td>" . $row["remark_ho"]. "</td>";
                                            // echo "<td>" . $row["billing_status"]. "</td>";
                                            // echo "<td>" . $row["invoice_no"]. "</td>";
                                            // echo "<td>" . $row["remark_i"]. "</td>";
                                            // echo "<td>" . $row["payment_status"]. "</td>";
                                            // echo "<td>" . $row["gst_payment"]. "</td>";
                                            // echo "<td>" . $row["gst_payment_amount"]. "</td>";                                            
                                            // echo "<td>" . $row["year"]. "</td>";
                                            // echo "<td>" . $row["month"]. "</td>";
                                            // echo "<td>" . $row["post_date"] . "</td>";
                                            // echo "<td>" . $row['status'] . "</td>";
                                            echo "</tr>";
                                        //}
                                    }
                                } else {
                                    echo "0 results";
                                }
                                echo "</table>";
                                ?>

















                        <!-- <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SN</th>
                                    <th>Ticket I'd</th>
                                    <th>Site Name</th>
                                    <th>Site Location</th>
                                    <th>Site Address</th>
                                    <th>Site I'd</th>
                                    <th>Job Type</th>
                                    <th>Comercial Rate</th>
                                    <th>Job Details</th>
                                    <th>Time Frame</th>
                                    <th>Contact Person</th>
                                    <th>Contact Number</th>
                                    <th>Report Format</th>
                                    <th>P_date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // session_start();
                                // if (isset($_SESSION['c_username'])) {
                                //     $c_username = $_SESSION['c_username'];
                                // }
                                //$employee_code = $_SESSION['employee_code'];
                                $sql = "SELECT * FROM customer_work WHERE c_id = '$c_id'";
                                //'".$_SESSION['username']."'
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["ticket_id"] . "</td>";
                                        echo "<td>" . $row["site_name"] . "</td>";
                                        echo "<td>" . $row["location"] . "</td>";
                                        echo "<td>" . $row["site_address"] . "</td>";
                                        echo "<td>" . $row["site_id"] . "</td>";
                                        echo "<td>" . $row["job"] . "</td>";
                                        echo "<td>" . $row["commercial_rate"] . "</td>";
                                        echo "<td>" . $row["job_details"] . "</td>";
                                        echo "<td>". $row["time_frame"]. "</td>";
                                        echo "<td>". $row["contact_person"]. "</td>";
                                        echo "<td>". $row["contact_number"]. "</td>";
                                        echo "<td>". $row["report_format"]. "</td>";
                                        echo "<td>" . $row["post_date"] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td hidden>" . $row["c_username"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "No Details Avialable";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table> -->
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
<?php include('customerfooter.php'); ?>