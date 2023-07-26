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
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">All Expense Report</h6>
                </div>
                <div class="card-body">
                    <!-- <form method="post"> -->
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="exampleInputEmail1">Select Expense Type</label>
                                <select id="expenseTypeDropdown" name="expenseTypeDropdown" class="form-control mb-3">
                                    <option value="">Select Expense Type</option>
                                    <option value="travelling">Travelling Expenses</option>
                                    <option value="tea_coffee">Tea/Coffee</option>
                                    <option value="meals_expenses">Meals Expenses</option>
                                    <option value="room_expenses">Room Expenses</option>
                                    <option value="tools_expenses">Tools Expenses</option>
                                    <option value="material_expenses">Material Expenses</option>
                                    <option value="money_transfer">Money Transfer</option>
                                </select>
                            </div>
                            
                        </div>
                    

                </div>
                <div id="expenseTableContainer"></div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                        // Handle dropdown change event
                        $('#expenseTypeDropdown').on('change', function() {
                            var selectedType = $(this).val();

                            // Check if the selected type is "travelling"
                            if (selectedType === 'travelling') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM texpense";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="checkdetail.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                            if (selectedType === 'tea_coffee') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM tea_coffee";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="TCcheckdetail.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                            if (selectedType === 'meals_expenses') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM meals_expenses";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="Mcheckdetails.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                            if (selectedType === 'room_expenses') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM room_expenses";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="Rcheckdetails.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                            if (selectedType === 'tools_expenses') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM tools_expenses";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="Tcheckdetails.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                            if (selectedType === 'material_expenses') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM material_expenses";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="MEcheckdetails.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                            if (selectedType === 'money_transfer') {
                            var tableHtml = `
                            <div class="table-responsive">
                            <div style="height: 500px;overflow-y:scroll;">
                                <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT id, site_name, date, status FROM money_transfer";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['site_name'] . '</td>';
                                        echo '<td>' . $row['date'] . '</td>';
                                        echo '<td>' . $row['status'] . '</td>';
                                        echo '<td><a href="MTcheckdetails.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                        echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                                </div>
                            `;

                            // Display the table HTML in the placeholder
                            $('#expenseTableContainer').html(tableHtml);
                            }
                        });
                        });
                        </script>

            </div>
        </div>
    </div>
</div>

<?php include('engineersfooter.php'); ?>