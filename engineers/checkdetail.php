<?php include('engineersheader.php'); ?>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggexpenses.php">Expences</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggTexp.php">Travelling Expence</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Expence</li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Travelling Expense</h6>
                    <div class="col-3 col-md-3 col-lg-3">
                        <a href="Travelexp.php" name="submit" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <div style="height: 500px;overflow-y:scroll;">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>KM</th>
                                    <th>Travelling Mode</th>
                                    <th>Fare</th>
                                    <th>Ticket</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM texpense";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['site_name'] . '</td>';
                                            echo '<td>' . $row['date'] . '</td>';
                                            echo '<td>' . $row['from_location'] . '</td>';
                                            echo '<td>' . $row['to_location'] . '</td>';
                                            echo '<td>' . $row['km'] . '</td>';
                                            echo '<td>' . $row['travelling_mode'] . '</td>';
                                            echo '<td>' . $row['fare'] . '</td>';
                                            echo '<td>' . $row['ticket'] . '</td>';
                                            echo '<td>' . $row['status'] . '</td>';
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
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>

<?php include('engineersfooter.php'); ?>