<?php include('engineersheader.php'); ?>

<?php
// Assuming you have established a database connection

// Check if the form is submitted
if (isset($_POST['Texpense'])) {
    // Get the form data
    $siteName = $_POST['site_name'];
    $date = $_POST['date'];
    $fromLocation = $_POST['from_location'];
    $toLocation = $_POST['to_location'];
    $km = $_POST['km'];
    $travellingMode = $_POST['travelling_mode'];
    $fare = $_POST['fare'];
    $ticket = $_POST['ticket'];

    // Prepare the SQL query
    $sql = "INSERT INTO texpense (site_name, date, from_location, to_location, km, travelling_mode, fare, ticket)
            VALUES ('$siteName', '$date', '$fromLocation', '$toLocation', $km, '$travellingMode', $fare, '$ticket')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Engineer Added successfully!');window.location.href='$_SERVER[PHP_SELF]'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggexpenses.php">Expences</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggTexp.php">Travelling Expence</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Expence</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Your Travel Expense</h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Select Site</label>
                                <?php
                                //$username = $_SESSION['username'];
                                session_start();
                                if(isset($_SESSION['username'])){
                                    $username = $_SESSION['username'];
                                }
                                $sql = "SELECT DISTINCT site_name FROM customer_work WHERE eusername = '$username'";
                                $result = $conn->query($sql);
                                echo '<select name="site_name" id="site_name" class="form-control mb-3">';
                                echo '<option value="">Choose a site</option>';
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row["site_name"].'">'.$row["site_name"].'</option>';
                                    }
                                }
                                echo '</select>';
                                ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Select Date</label>
                                <input type="date" class="form-control" id="date" name="date" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cc-payment" class="control-label mb-1">From</label>
                                <input id="from_location" name="from_location" required class="form-control" aria-invalid="false" placeholder="From">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">To</label>
                                <input id="to_location" name="to_location" required class="form-control" aria-invalid="false" placeholder="To">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Kilometer</label>
                                <input id="km" name="km" required class="form-control" aria-invalid="false" placeholder="Kilometer">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Travelling Mode</label>
                                <input id="travelling_mode" name="travelling_mode" required class="form-control" aria-invalid="false" placeholder="Travelling Mode">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Fare</label>
                                <input id="fare" name="fare" required class="form-control" aria-invalid="false" placeholder="Fare">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Ticket (Optional)</label>
                                <input id="ticket" name="ticket" type="file" class="form-control" aria-invalid="false" >
                            </div>
                            <div class="form-group col-md-1">
                            <label for="exampleInputPassword1" style="color: white;">Password</label>
                                <button class="form-control" type="submit" name="Texpense" class="btn btn-primary" style="background-color:#6777ef;color:white;" >ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('engineersfooter.php'); ?>