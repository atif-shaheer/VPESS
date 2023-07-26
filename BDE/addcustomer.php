<?php include('bdeheader.php'); ?>

<?php
if (isset($_POST['addcustomer'])) {
    $c_id = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $postdate = date('Y-m-d H:i:s');
    $c_username = mysqli_real_escape_string($conn, $_POST['c_username']);
    $status = "active";
    $sql = "INSERT INTO customers (c_id, password, c_username, status, postdate)
    VALUES ('$c_id', '$password', '$c_username', '$status', '$postdate')";
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location: areahead.php");
    echo "<script>alert('Customer Added Successfully!');window.location.href='$_SERVER[PHP_SELF]'</script>";
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
                                <h4>Add Customers</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Userame</label>
                                        <input id="c_username" name="c_username" type="text" class="form-control"
                                            required="" placeholder="Please Enter Username">
                                    </div>
                                    <!-- <div class="form-group col-md-4">
                                        <label>Employee Code</label>
                                        <input id="employee_code" name="employee_code" type="text" class="form-control"
                                            required="" maxlength="4" placeholder="Please Enter Employee Code">
                                    </div> -->
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

                </div>

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customers Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tbody>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>C_ID</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>PostDate</th>
                                        </tr>
                                        <?php

                                        if (isset($_GET['update'])) {
                                            $id = $_GET['update'];
                                            $status = "active";
                                            if ($status == "active") {
                                                $sql = "UPDATE customers SET status='inactive' WHERE id='$id'";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result) {
                                                    echo "<script>location.href='addcustomer.php';</script>";
                                                }
                                            }
                                        }

                                        ?>

                                        <?php
                                        $sql = "SELECT * FROM customers";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["c_username"] . "</td>";
                                                echo "<td>" . $row["c_id"] . "</td>";
                                                echo "<td>" . $row["password"] . "</td>";
                                                echo "<td><a href='addcustomer.php?update=" . $row['id'] . " '>" . $row['status'] . "</a></td>";
                                                echo "<td>" . $row["postdate"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "No Customer Avialable";
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
<?php include('bdefooter.php'); ?>