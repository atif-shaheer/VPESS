<?php include('ceoheader.php'); ?>
<div class="main-content" style="min-height: 530px;">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <!-- <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form method="post">
                            <div class="card-header">
                                <h4>Add Service Head</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Userame</label>
                                        <input id="username" name="username" type="text" class="form-control"
                                            required="" placeholder="Please Enter Username">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Employee Code</label>
                                        <input id="employee_code" name="employee_code" type="text" class="form-control"
                                            required="" maxlength="4" placeholder="Please Enter Employee Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Password</label>
                                        <input id="password" name="password" type="password" class="form-control"
                                            required="" placeholder="Please Enter Password">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" name="addservicehead" class="btn btn-primary">Add</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div> -->

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Service Head Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>SN</th>
                                            <th>Username</th>
                                            <th>Employee Code</th>
                                            <th>Password</th>
                                            <th>Staus</th>
                                            <th>PostDate</th>
                                        </tr>
                                        <?php

                                        if(isset($_GET['update'])) {
                                        $id = $_GET['update'];
                                        $status = "active";
                                        if ($status == "active") {
                                            $sql = "UPDATE service_head SET status='inactive' WHERE id='$id'";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result) {
                                                echo "<script>location.href='servicehead.php';</script>";
                                            }
                                        }
                                        }

                                        ?>

                                        <?php                                        
                                        // Prepare the SQL query to select all rows from the coo table
                                        $sql = "SELECT * FROM service_head";
                                        
                                        // Execute the query and get the result set
                                        $result = $conn->query($sql);
                                        
                                        // Check if there are any rows returned
                                        if ($result->num_rows > 0) {                                          
                                          // Output each row in the result set
                                          while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["username"] . "</td>";
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
<?php include('ceofooter.php'); ?>