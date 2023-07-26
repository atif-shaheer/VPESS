<?php include('bdmheader.php'); ?>

<?php
// Check if the form has been submitted
if (isset($_POST['addbde'])) {
  // Get the values of the input fields
  $type = $_POST['type'];
  $username = $_POST['username'];
  $employee_code = $_POST['employee_code'];
  $password = $_POST['password'];
  $status = "active"; // set status to "active"
  $postdate = date('Y-m-d H:i:s'); // get current date and time
  
  $sql = "INSERT INTO bde (type, username, employee_code, password, status, postdate) 
          VALUES ('$type','$username', '$employee_code', '$password', '$status', '$postdate')";
    if ($conn->query($sql) === TRUE) {
    echo "BDE Added successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
  // Redirect to a success page
  header("Location: bde.php");
  // Display a success message using JavaScript
  echo "<script>alert('User Added successfully!');window.location.href='$_SERVER[PHP_SELF]'</script>";
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
                                <h4>Add BDE</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="type">Type</label>
                                        <select id="type" name="type" class="form-control" required>
                                            <option value="">Select User type</option>
                                            <option value="BDE">BDE</option>
                                            <option value="Customer Co-ordinator">Customer Co-ordinator</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Userame</label>
                                        <input id="username" name="username" type="text" class="form-control"
                                            required="" placeholder="Please Enter Username">
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
                                    <button type="submit" name="addbde" class="btn btn-primary">Add</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>BDE Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>SN</th>
                                            <th>Type</th>
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
                                            $sql = "UPDATE bde SET status='inactive' WHERE id='$id'";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result) {
                                                echo "<script>alert('User Inactive!')location.href='bde.php';</script>";
                                            }
                                        }
                                        }

                                        ?>

                                        <?php                                        
                                        // Prepare the SQL query to select all rows from the coo table
                                        $sql = "SELECT * FROM bde";
                                        
                                        // Execute the query and get the result set
                                        $result = $conn->query($sql);
                                        
                                        // Check if there are any rows returned
                                        if ($result->num_rows > 0) {                                          
                                          // Output each row in the result set
                                          while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["type"] . "</td>";
                                            echo "<td>" . $row["username"] . "</td>";
                                            echo "<td>" . $row["employee_code"] . "</td>";
                                            echo "<td>" . $row["password"] . "</td>";
                                            echo "<td><a href='bde.php?update=" . $row['id'] . " '>" . $row['status'] . "</a></td>";
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
<?php include('bdmfooter.php'); ?>