<?php include('serviceheadheader.php'); ?>

<div class="main-content" style="min-height: 530px;">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customers Report</h4>
                            <div class="card-header-form">
                                <form method="post">
                                    <div class="input-group">
                                    <!-- <input type="text" class="form-control" placeholder="Search"> -->
                                        <select name="job" id="job" class="form-control">
                                            <option value="">-- Select Job Type --</option>
                                            <option value="Installation Work">Installation Work</option>
                                            <option value="Visit">Visit</option>
                                            <option value="Service Work">Service Work</option>
                                            <option value="Site Service Work">Site Service Work</option>
                                            <option value="Dismantling Work">Dismantling Work</option>
                                            <option value="Dismantling And Installaton">Dismantling And Installaton</option>
                                        </select>
                                    <div class="input-group-btn">
                                        <button style="padding: 8.8px;" type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <div style="height: 450px;overflow-y:scroll;">
                                <?php
                                if (isset($_GET['checked'])) {
                                    $id = $_GET['checked'];
                                    $checked = "checked";
                                    if ($checked == "checked") {
                                        $sql = "UPDATE customer_work SET checked='checked' WHERE id='$id'";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            echo "<script>alert('Work Checked successfully!');window.location.href='shcustomerrpt.php';</script>";
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
                                $sql = "SELECT * FROM customer_work WHERE department_type= 'Service Head' AND work_check='approved' AND rate_check='approved' AND state_location=state_location Order By post_date DESC";
                                $result = mysqli_query($conn, $sql);
                                echo "<table class='table table-bordered table-md'>";
                                echo "<thead><tr>";
                                echo "<th style='text-align:center;'>SN</th>";
                                // echo "<th style='text-align:center'>View</th>";
                                echo "<th style='text-align:center'>Ticket I'd</th>";
                                echo "<th style='text-align:center'>Site Name</th>";
                                echo "<th style='text-align:center'>Site Location</th>";
                                echo "<th style='text-align:center'>Site Address</th>";
                                echo "<th style='text-align:center'>Site I'd</th>";
                                echo "<th style='text-align:center'>Job Type</th>";
                                // echo "<th style='text-align:center'>Comercial Rate</th>";
                                echo "<th style='text-align:center'>Job Details</th>";
                                echo "<th style='text-align:center'>Deadline</th>";
                                echo "<th style='text-align:center'>Contact Person</th>";
                                echo "<th style='text-align:center'>Contact Number</th>";
                                echo "<th style='text-align:center'>Company Name</th>";
                                echo "<th style='text-align:center'>Pro Co-ordinator</th>";
                                // echo "<th style='text-align:center'>Customer Id</th>";
                                echo "<th style='text-align:center'>Work Check</th>";
                                echo "<th style='text-align:center'>Rate Check</th>";
                                echo "<th style='text-align:center'>Checked</th>";

                                // echo "<th style='text-align:center'>State Location</th>";
                                // echo "<th style='text-align:center'>Department Type</th>";
                                // echo "<th style='text-align:center'>Other Charges Detail</th>";
                                // echo "<th style='text-align:center'>Total Charges</th>";
                                // echo "<th style='text-align:center'>Work Order</th>";
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
                                // if (!in_array("Live", $hide_columns)) {
                                //     echo "<th style='text-align:center'>Live</th>";
                                // }
                                // echo "<th style='text-align:center'>Live Visit Date</th>";
                                // echo "<th style='text-align:center'>Work Status</th>";
                                // echo "<th style='text-align:center'>Remark W</th>";
                                // echo "<th style='text-align:center'>HO Report</th>";
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
                                    while($row = mysqli_fetch_assoc($result)) {
                                        if ($row['job'] == $job) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            // echo "<td> <a class='btn btn-primary' href='pick.php?id=" . $row["id"] . "'><i class='fa fa-eye'></i></a></td>";
                                            echo "<td>" . $row["ticket_id"] . "</td>";
                                            echo "<td>" . $row["site_name"] . "</td>";
                                            echo "<td>" . $row["location"] . "</td>";
                                            echo "<td>" . $row["site_address"]. "</td>";
                                            echo "<td>" . $row["site_id"] . "</td>";
                                            echo "<td>" . $row["job"] . "</td>";
                                            // echo "<td>" . $row["commercial_rate"] . "</td>";
                                            echo "<td>" . $row["job_details"] . "</td>";
                                            echo "<td>" . $row["time_frame"]. "</td>";
                                            echo "<td>" . $row["contact_person"]. "</td>";
                                            echo "<td>" . $row["contact_number"]. "</td>";
                                            echo "<td>" . $row["company_name"]. "</td>";
                                            echo "<td>" . $row["c_username"] . "</td>";
                                            // echo "<td>" . $row["c_id"]. "</td>";
                                            echo "<td>" . $row['work_check'] . "</td>";
                                            echo "<td>" . $row['rate_check'] . "</td>";
                                            echo "<td><a href='shcustomerrpt.php?checked=" . $row["id"] . "'>". $row['checked']. "</a></td>";
                                            // echo "<td><a href='updateSD.php?id=" . $row["id"] . "'>" . $row['state_location'] . "</a></td>";
                                            // echo "<td><a href='updateSD.php?id=" . $row["id"] . "'>" . $row["department_type"]. "</a></td>";
                                            // echo "<td>" . $row["other_charges_detail"]. "</td>";
                                            // echo "<td>" . $row["total_charges"]. "</td>";
                                            // echo "<td>" . $row["work_order"]. "</td>";                                            
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
                                            // if (!in_array("Live", $hide_columns)) {
                                            //     echo "<td>" . $row['live'] . "</td>";
                                            // }
                                            // echo "<td>" . $row["live_visit_date"]. "</td>";
                                            // echo "<td>" . $row["work_status"]. "</td>";
                                            // echo "<td>" . $row["remark_w"]. "</td>";
                                            // echo "<td>" . $row["ho_report"]. "</td>";
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

<?php include('serviceheadfooter.php'); ?>