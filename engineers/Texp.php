<?php include('engineersheader.php'); ?>

<?php
// Assuming you have already established a database connection

// Check if the form is submitted
if (isset($_POST['tools_expenses'])) {
    // Get the values from the form
    $siteName = $_POST['site_name'];
    $date = $_POST['date'];
    $approved_by = $_POST['approved_by'];
    $tools_details = $_POST['tools_details'];
    $priceCost = $_POST['price_cost'];
    $invoice = $_POST['Invoice'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tools_expenses (site_name, date, approved_by, tools_details, price_cost, Invoice) 
            VALUES ('$siteName', '$date', '$approved_by', '$tools_details', '$priceCost', '$invoice')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your Tools Expense Added Successfully!');window.location.href='Toolsexp.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggexpenses.php">Expences</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="Toolsexp.php">Tools Expence</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Expence</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add Your Tools Expense</h6>
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
                                <label for="cc-payment" class="control-label mb-1">Approved by</label>
                                <input id="approved_by" name="approved_by" type="text" required class="form-control" aria-invalid="false" placeholder="Approved By">                          
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Tools Details</label>
                                <input id="tools_details" name="tools_details" required class="form-control" aria-invalid="false" placeholder="Tools Details">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Price/Cost</label>
                                <input id="price_cost" name="price_cost" type="number" required class="form-control" aria-invalid="false" placeholder="Price/Cost">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="cc-payment" class="control-label mb-1">Invoice(optional)</label>
                                <input id="Invoice" name="Invoice" type="file" class="form-control" aria-invalid="false" >
                            </div>
                            <div class="form-group col-md-1">
                            <label for="exampleInputPassword1" style="color: white;">Password</label>
                                <button class="form-control" type="submit" name="tools_expenses" class="btn btn-primary" style="background-color:#6777ef;color:white;" >ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('engineersfooter.php'); ?>