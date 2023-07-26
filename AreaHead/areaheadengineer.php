<?php include('areaheadheader.php'); ?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}
?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
    header("Location: areaheadlogin.php");
    exit();
}

if (isset($_POST['addengineer'])) {
    // Get the values of the input fields
    $type = $_POST['type'];
    $username = $_POST['username'];
    $ausername = $_POST['ausername'];
    $employee_code = $_POST['employee_code'];
    $password = $_POST['password'];
    $state = $_POST['state'];
    $location = $_POST['location'];
    $status = "active"; // set status to "active"
    $postdate = date('Y-m-d H:i:s'); // get current date and time
    $sql = "INSERT INTO engineers (type, username, ausername, employee_code, password, state, location, status, postdate)
          VALUES ('$type', '$username', '$ausername', '$employee_code', '$password', '$state', '$location', '$status', '$postdate')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Engineer Added successfully!');window.location.href='$_SERVER[PHP_SELF]'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    exit();
}

?>

<div class="container-fluid" id="container-wrapper">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="areaheadindex.php">Home</a></li>
            <li class="breadcrumb-item">Engineer</li>
            <li class="breadcrumb-item active" aria-current="page">Add Engineers</li>
        </ol>
    </div> -->

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->

            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Engineers</h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Select Engineer</label>
                                <select class="form-control mb-3" name="type">
                                    <option>Select</option>
                                    <option>Engineer</option>
                                    <option>Trainee Engineer</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    aria-describedby="emailHelp" placeholder="Enter Name">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your
                                    email with anyone else.</small> -->
                            </div>
                            <div hidden class="form-group col-md-3">
                                <?php
                                session_start();
                                if(isset($_SESSION['username'])){
                                    $username = $_SESSION['username'];
                                }

                                // session_start(); 
                                // $ahusername = $_SESSION['username'];
                                // $sql = "SELECT username FROM area_head WHERE username = '$ahusername'";
                                // $result = $conn->query($sql);
                                // if ($result->num_rows > 0) {
                                // $row = $result->fetch_assoc();
                                // $ahusername = $row['username'];
                                // } else {
                                // $ahusername = "";
                                // }
                                ?>
                                <label for="exampleInputEmail1">Area</label>
                                <input type="text" class="form-control" name="ausername" value="<?php echo $username; ?>" readonly>                            
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Employee Code</label>
                                <input maxlength="4" type="text" class="form-control" id="employee_code" name="employee_code"
                                    aria-describedby="emailHelp" placeholder="Enter Employee Code">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your
                                    email with anyone else.</small> -->
                            </div>
                            <div class="form-group col-md-2">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password">
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
                                <label for="exampleInputEmail1">Site City</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    aria-describedby="emailHelp" placeholder="Enter Site Location">
                            </div>
                            <div class="form-group col-md-1">
                            <label for="exampleInputPassword1" style="color: white;">Password</label>
                                <button class="form-control" type="submit" name="addengineer" class="btn btn-primary" style="background-color:#6777ef;color:white;" >ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Engineers Report</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>SN</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Employee Code</th>
                        <th>Password</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>P_date</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    session_start(); 
                    if (isset($_GET['update'])) {
                        $id = $_GET['update'];
                        $status = "active";
                        if ($status == "active") {
                            $sql = "UPDATE engineers SET status='inactive' WHERE id='$id'";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                echo "<script>location.href='areaheadengineer.php';</script>";
                            }
                        }
                    }
                    ?>

                    <?php
                    session_start();
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                    }
                    //$employee_code = $_SESSION['employee_code'];
                    $sql = "SELECT * FROM engineers WHERE ausername = '$username' ";
                    //'".$_SESSION['username']."'
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["employee_code"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["state"] . "</td>";
                            echo "<td>" . $row["location"] . "</td>";
                            echo "<td><a href='areaheadengineer.php?update=" . $row['id'] . " '>" . $row['status'] . "</a></td>";
                            echo "<td>" . $row["postdate"] . "</td>";
                            echo "<td hidden>" . $row["ausername"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No Data Avialable";
                    }
                    $conn->close();
                    ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

    </div>
</div>

<?php include('areaheadfooter.php'); ?>