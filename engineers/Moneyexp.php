<?php include('engineersheader.php'); ?>

<?php
// Assuming you have already established a database connection

// Check if the form is submitted
if (isset($_POST['money_transfer'])) {
    // Get the values from the form
    $site_name = $_POST['site_name'];
    $date = $_POST['date'];
    $room = $_POST['room'];
    $transfer_to = $_POST['transfer_to'];
    $payment_mode = $_POST['payment_mode'];
    $transfer_amount = $_POST['transfer_amount'];
    $invoice = $_POST['invoice'];

    // Prepare the SQL statement
    $sql = "INSERT INTO money_transfer (site_name, date, room, transfer_to, payment_mode, transfer_amount, invoice) 
            VALUES ('$site_name', '$date', '$room', '$transfer_to', '$payment_mode', '$transfer_amount', '$invoice')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your Money Transfer Successfull!');window.location.href='MTexp.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // print_r($sql);
    }
}
?>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggexpenses.php">Expences</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="MTexp.php">Money Expence</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Expence</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Your Money</h6>
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
                                <!-- <select class="form-control mb-3" name="type">
                                    <option>Select</option>
                                    <option>Engineer</option>
                                    <option>Trainee Engineer</option>
                                </select> -->
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1">Select Date</label>
                                <input type="date" class="form-control" id="date" name="date" aria-describedby="emailHelp">
                                <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your
                                    email with anyone else.</small> -->
                            </div>
                            <div class="form-group col-md-3">
                                <label for="cc-payment" class="control-label mb-1">Room</label>
                                <input id="room" name="room" type="text" required class="form-control" aria-invalid="false" placeholder="Room">                          
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Transfer To</label>
                                <input id="transfer_to" name="transfer_to" required class="form-control" aria-invalid="false" placeholder="Transfer To">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Payment Mode</label>
                                <input id="payment_mode" name="payment_mode" type="Text" required class="form-control" aria-invalid="false" placeholder="Payment Mode">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Transfer Amount</label>
                                <input id="transfer_amount" name="transfer_amount" type="number" required class="form-control" aria-invalid="false" placeholder="Transfer Amount">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Invoice(optional)</label>
                                <input id="invoice" name="invoice" type="file" class="form-control" aria-invalid="false" >
                            </div>
                            <div class="form-group col-md-1">
                            <label for="exampleInputPassword1" style="color: white;">Password</label>
                                <button class="form-control" type="submit" name="money_transfer" class="btn btn-primary" style="background-color:#6777ef;color:white;" >ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('engineersfooter.php'); ?>