<?php include('bdeheader.php'); ?>
<div class="main-content" style="min-height: 530px;">

    <!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                hjhj
              </div>
            </div>
        </div>
    </div> -->

    <section class="section">
        <div class="section-body">
            <div class="row">
                <!-- <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post">
                            <div class="card-header">
                                <h4>Add Customers</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Userame</label>
                                        <input id="c_username" name="c_username" type="text" class="form-control"
                                            required="" placeholder="Please Enter Username">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Employee Code</label>
                                        <input id="employee_code" name="employee_code" type="text" class="form-control"
                                            required="" maxlength="4" placeholder="Please Enter Employee Code">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password</label>
                                        <input id="password" name="password" type="password" class="form-control"
                                            required="" placeholder="Please Enter Password">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" name="addcustomer" class="btn btn-primary">Add</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div> -->

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Jobs</h4>
                            <h4 style="text-align:center;">
                                <?php
                                if(isset($_POST['submit'])) {
                                    $company_name = $_POST['company_name'];
                                    $sql = "SELECT c_username, COUNT(site_id) AS site_count FROM customer_work WHERE work_check = 'unapproved' AND rate_check = 'unapproved' AND company_name='$company_name' GROUP BY c_username";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo '<h4 style="text-align:center;color: red;">'.$row["c_username"].' :  '.$row["site_count"].'</h4>';
                                        }
                                    } else {
                                        echo '<p style="text-align:center;color: red;">No data found.</p>';
                                    }
                                }
                                ?>
                            </h4>
                            <div class="card-header-form">
                                <?php
                                $sql = "SELECT DISTINCT company_name FROM customer_work";
                                $result = $conn->query($sql);

                                // Display dropdown list of company names
                                echo '<form method="post">';
                                    echo '<div class="input-group">';
                                        echo '<select name="company_name" class="form-control">';
                                            echo '<option value="">Select a company</option>';
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="'.$row["company_name"].'"';
                                                    // if ($_GET['company_name'] == $row["company_name"]) {
                                                    //     echo ' selected';
                                                    // }
                                                    echo '>'.$row["company_name"].'</option>';
                                                }
                                            }
                                        echo '</select>';
                                    echo '<div class="input-group-btn">';
                                        echo '<button style="padding: 8.8px;" type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>';
                                    echo '</div>';
                                    echo '</div>';
                                echo '</form>';
                                ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- <table class="table table-bordered table-md"> -->
                                    <div style="height: 500px;overflow-y:scroll;">
                                            <?php
                                                $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
                                                                                   
                                                $sql = "SELECT * FROM customer_work WHERE work_check = 'unapproved' AND rate_check = 'unapproved'";
                                                
                                                if (!empty($company_name)) {
                                                    $sql .= " AND company_name = '$company_name'";
                                                }
                                                $sql .= " ORDER BY time_frame ASC";
                                                
                                                $result = mysqli_query($conn, $sql);
                                                echo "<table class='table table-bordered table-md'>";
                                                echo "<thead class='thead-light'><tr>";
                                                echo "<th style='text-align:center'>SN</th>";
                                                echo "<th style='text-align:center'>Verified Customer</th>";
                                                echo "<th style='text-align:center'>Check In</th>";
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
                                                echo "<th style='text-align:center'>Work Order</th>";
                                                echo "<th style='text-align:center'>Work Check</th>";
                                                echo "<th style='text-align:center'>Rate Check</th>";
                                                echo "</tr></thead>";
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr onclick='displayData(" . $row['id'] . ")'>"; 
                                                            echo "<td>" . $row["id"] . "</td>";
                                                            echo "<td style='text-align:center'><i style='font-size:20px;color:#39e339;' class='fas fa-check-circle'></i></td>";
                                                            echo "<td><a href='checkins.php?id=" . $row['id'] . "' type='button' class='btn btn-primary'><i class='fas fa-clipboard-check'></i></a></td>"; // data-toggle='modal' data-target='.bd-example-modal-lg'
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
                                                            echo "<td>" . $row["work_order"] . "</td>";
                                                            echo "<td>" . $row["work_check"] . "</td>";
                                                            echo "<td>" . $row["work_check"] . "</td>";
                                                            echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='12'>0 results</td></tr>";
                                                }
                                                echo "</table>";                                            
                                                ?>
                                    </div>
                                <!-- </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('bdefooter.php'); ?>