<?php include('serviceheadheader.php'); ?>

<?php
// Check if the form has been submitted
if (isset($_POST['addareahead'])) {
    // Get the values of the input fields
    $username = $_POST['username'];
    $area = $_POST['area'];
    //$state_location = $_POST['state_location'];
    $employee_code = $_POST['employee_code'];
    $password = $_POST['password'];
    $status = "active"; // set status to "active"
    $postdate = date('Y-m-d H:i:s'); // get current date and time

    $query = mysqli_query($conn,"select * from area_head where employee_code=$employee_code  ");

    if(mysqli_num_rows($query) > 0){
        $msg="This Employee Code is already Existed";
    }else{
        $sql = "INSERT INTO area_head (username, area, employee_code, password, status, postdate)
                VALUES ('$username', '$area', '$employee_code', '$password', '$status', '$postdate')";
        
        //run insert query 
        $insert_row = mysqli_query($conn,$sql);
          
        if($insert_row){
            echo "<script>alert('Area Head Added successfully!');window.location.href='$_SERVER[PHP_SELF]'</script>";
        }else{
            echo "Error Inserting Data!";
        }
    }

    // $sql = "INSERT INTO area_head (username, area, employee_code, password, status, postdate)
    //       VALUES ('$username', '$area', '$employee_code', '$password', '$status', '$postdate')";
    // if ($conn->query($sql) === TRUE) {
    //     echo "Area Head Added successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // Redirect to a success page
    //header("Location: areahead.php");
    // Display a success message using JavaScript
    
    exit();
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
                                <h4>Add Area Head</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Userame</label>
                                        <input id="username" name="username" type="text" class="form-control"
                                            required="" placeholder="Please Enter Username">
                                    </div>
                                    <!-- <div class="form-group col-md-3">
                                            <label>Select State Location</label>
                                            <select name="area" id="area" class="form-control">
                                                <option value="">Select State</option>
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
                                        </div> -->

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
                                    <div class="form-group col-md-1">
                                        <label>Password</label>
                                        <button type="submit" name="addareahead" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                                <!-- <div class="card-footer text-right">
                                    <button type="submit" name="addareahead" class="btn btn-primary">Add</button>
                                </div> -->
                            </div>

                        </form>
                    </div>

                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Area Head Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>SN</th>
                                            <th>Username</th>
                                            <!-- <th>Area</th> -->
                                            <th>Employee Code</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>PostDate</th>
                                        </tr>
                                        <?php

                                        if (isset($_GET['update'])) {
                                            $id = $_GET['update'];
                                            $status = "active";
                                            if ($status == "active") {
                                                $sql = "UPDATE area_head SET status='inactive' WHERE id='$id'";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result) {
                                                    echo "<script>location.href='areahead.php';</script>";
                                                }
                                            }
                                        }

                                        ?>

                                        <?php
                                        // Prepare the SQL query to select all rows from the coo table
                                        $sql = "SELECT * FROM area_head";

                                        // Execute the query and get the result set
                                        $result = $conn->query($sql);

                                        // Check if there are any rows returned
                                        if ($result->num_rows > 0) {
                                            // Output each row in the result set
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["username"] . "</td>";
                                                //echo "<td>" . $row["area"] . "</td>";
                                                echo "<td>" . $row["employee_code"] . "</td>";
                                                echo "<td>" . $row["password"] . "</td>";
                                                echo "<td><a href='coo.php?update=" . $row['id'] . " '>" . $row['status'] . "</a></td>";
                                                echo "<td>" . $row["postdate"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "No Data Avialable";
                                        }

                                        // Close the connection
                                        $conn->close();
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1 <span
                                                class="sr-only">(current)</span></a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<?php include('serviceheadfooter.php'); ?>