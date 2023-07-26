<?php include('areaheadheader.php'); ?>

<?php
// Assuming you have a database connection established

// Retrieve data from the verify_customer table
$query = "SELECT * FROM customer_work";
$result = mysqli_query($conn, $query);

// Store the site_id and time_frame values in an array
$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = [
        'title' => 'Site ID: ' . $row['site_id'],
        'start' => $row['time_frame'],
        'data' => $row // Store the entire row as data for the event
    ];
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

        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <div class="col-md-1.5">
                                <h6 class="m-0 font-weight-bold text-primary">Pending Sites</h6>
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#calendarModal">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <div class="modal fade-in" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="calendarModalLabel">Calendar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id='calendar' class="text-dark"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <script>
                                $(document).ready(function() {
                                    // Initialize FullCalendar
                                    $('#calendar').fullCalendar({
                                        events: <?php echo json_encode($events); ?>,
                                        eventClick: function(event) {
                                            // Display the data in a Bootstrap table
                                            var rowData = event.data;
                                            var html = "<table class='table'>";
                                            for (var key in rowData) {
                                                if (rowData.hasOwnProperty(key)) {
                                                    html += "<tr><th>" + key + "</th><td style='color: white;'>" + rowData[key] + "</td></tr>";
                                                }
                                            }
                                            html += "</table>";
                                            $("#event-details-table tbody").html(html);
                                        }
                                    });

                                    // Initialize DataTables for the event details table
                                    $('#event-details-table').DataTable({
                                        searching: false,
                                        ordering: false,
                                        info: false,
                                        paging: false,
                                        responsive: true
                                    });
                                });
                            </script>




                            <div class="col-md-9">
                                <?php
                                echo '<form method="post">';
                                echo '<div class="row">';
                                echo '<div class="col-md-3">';
                                // Display dropdown list of states
                                $sql = "SELECT DISTINCT state FROM customer_work";
                                $result = $conn->query($sql);

                                echo '<select name="state" id="state" class="form-control mt-2" onchange="fetchLocations()">';
                                echo '<option value="">Select State</option>';
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["state"] . '"';
                                        if (isset($_POST['state']) && $_POST['state'] == $row["state"]) {
                                            echo ' selected';
                                        }
                                        echo '>' . $row["state"] . '</option>';
                                    }
                                }
                                echo '</select>';
                                echo '</div>';

                                echo '<div class="col-md-3">';
                                // Display initial empty location dropdown
                                echo '<select name="location" id="location" class="form-control mt-2">';
                                echo '<option value="">Select City</option>';
                                echo '</select>';
                                echo '</div>';

                                $sql = "SELECT DISTINCT time_frame FROM customer_work";
                                $result = $conn->query($sql);

                                echo '<div class="col-md-3">';
                                echo '<input type="date" name="time_frame" class="form-control mt-2" value="' . (isset($_POST['time_frame']) ? $_POST['time_frame'] : '') . '" onfocus="this.placeholder = \'Select Deadline Date\'" onblur="this.placeholder = \'\'">';
                                echo '</div>';

                                echo '<div class="col-md-1 mt-2">';
                                echo '<button style="padding: 7px;" type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>';
                                echo '</div>';

                                echo '</div>';
                                echo '</form>';

                                ?>
                            </div>
                            <!-- <div class="col-md-1.5">
                                <h6 style="text-align:center;">
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $location = $_POST['location'];
                                        $state = $_POST['state'];
                                        $time_frame = $_POST['time_frame'];
                                        $sql = "SELECT c_username, COUNT(site_id) AS site_count FROM customer_work WHERE work_check = 'approved' AND rate_check = 'approved' AND time_frame='$time_frame' OR state='$state' OR location='$location' GROUP BY c_username";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<h6 style="text-align:center;color: red;">' . $row["c_username"] . ' :  ' . $row["site_count"] . '</h6>';
                                            }
                                        } else {
                                            echo '<p style="text-align:center;color: red;">No data found.</p>';
                                        }
                                    }
                                    ?>
                                </h6>
                            </div> -->
                            <div class="col-md-1">
                                <button class='assign-button btn btn-primary' name="assign" disabled>Assign</button>
                            </div>
                            <script>
                                function fetchLocations() {
                                    var state = document.getElementById("state").value;
                                    var locationDropdown = document.getElementById("location");

                                    // Clear previous options in the location dropdown
                                    locationDropdown.innerHTML = '<option value="">Select a location</option>';

                                    // If a state is selected, fetch corresponding locations
                                    if (state !== '') {
                                        // Make an AJAX request to fetch locations based on the selected state
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'fetch_locations.php', true);
                                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                                // Populate the location dropdown with the fetched options
                                                var locations = JSON.parse(xhr.responseText);
                                                if (locations.length > 0) {
                                                    for (var i = 0; i < locations.length; i++) {
                                                        var option = document.createElement("option");
                                                        option.value = locations[i];
                                                        option.text = locations[i];
                                                        locationDropdown.appendChild(option);
                                                    }
                                                } else {
                                                    var option = document.createElement("option");
                                                    option.value = "";
                                                    option.text = "No locations found";
                                                    locationDropdown.appendChild(option);
                                                }
                                            }
                                        };
                                        xhr.send("state=" + state);
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <div style="height: 500px;overflow-y:scroll;">
                        <?php
                        $time_frame = isset($_POST['time_frame']) ? $_POST['time_frame'] : '';
                        $location = isset($_POST['location']) ? $_POST['location'] : '';
                        $state = isset($_POST['state']) ? $_POST['state'] : '';

                        $sql = "SELECT * FROM customer_work WHERE work_check = 'approved' AND rate_check = 'approved' AND work_status = 'Pending'";

                        if (!empty($time_frame)) {
                            $sql .= " AND time_frame = '$time_frame'";
                        }

                        if (!empty($location)) {
                            $sql .= " AND location = '$location'";
                        }

                        if (!empty($state)) {
                            $sql .= " AND state = '$state'";
                        }

                        $sql .= " ORDER BY time_frame ASC limit 20";

                        $result = mysqli_query($conn, $sql);

                        echo "<table class='table table-bordered table-md'>";
                        echo "<thead class='thead-light'><tr>";
                        echo "<th style='text-align:center'>SN</th>";
                        echo "<th style='text-align:center'>Assign Task</th>";
                        echo "<th style='text-align:center'>Ticket I'd</th>";
                        echo "<th style='text-align:center'>Site Name</th>";
                        echo "<th style='text-align:center'>Site Address</th>";
                        echo "<th style='text-align:center'>Site I'd</th>";
                        echo "<th style='text-align:center'>Job Type</th>";
                        echo "<th style='text-align:center'>Comercial Rate</th>";
                        echo "<th style='text-align:center'>Job Details</th>";
                        echo "<th style='text-align:center'>Deadline</th>";
                        echo "<th style='text-align:center'>Contact Person</th>";
                        echo "<th style='text-align:center'>Contact Number</th>";
                        echo "<th style='text-align:center'>Work Order</th>";
                        echo "<th style='text-align:center'>Work Check</th>";
                        echo "<th style='text-align:center'>Rate Check</th>";
                        echo "<th style='text-align:center'>Work Status</th>";
                        echo "</tr></thead>";

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr onclick='displayData(" . $row['id'] . ")'>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>";
                                if (isset($_GET['ids']) && in_array($row["id"], explode(",", $_GET['ids']))) {
                                    echo "<input type='checkbox' class='assign-checkbox input-group' name='selected_sites[]' value='" . $row["id"] . "' checked>";
                                } else {
                                    echo "<input type='checkbox' class='assign-checkbox input-group' name='selected_sites[]' value='" . $row["id"] . "'>";
                                }
                                echo "</td>";
                                echo "<td>" . $row["ticket_id"] . "</td>";
                                echo "<td>" . $row["site_name"] . "</td>";
                                echo "<td>" . $row["site_address"] . "</td>";
                                echo "<td>" . $row["site_id"] . "</td>";
                                echo "<td>" . $row["job"] . "</td>";
                                echo "<td>" . $row["commercial_rate"] . "</td>";
                                echo "<td>" . $row["job_details"] . "</td>";
                                echo "<td>" . $row["time_frame"] . "</td>";
                                echo "<td>" . $row["contact_person"] . "</td>";
                                echo "<td>" . $row["contact_number"] . "</td>";
                                echo "<td>" . $row["work_order"] . "</td>";
                                echo "<td>" . $row["work_check"] . "</td>";
                                echo "<td>" . $row["rate_check"] . "</td>";
                                echo "<td>" . $row["work_status"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<h5 style='background-color:#df0000;color:white;padding:1%;'>No Site Found</h5>";
                        }

                        echo "</table>";
                        ?>

                        <script>
                            $(document).ready(function() {
                                // Enable assign button when at least one checkbox is selected
                                $('.assign-checkbox').on('change', function() {
                                    var checked = $('.assign-checkbox:checked').length;
                                    var assignButton = $('.assign-button');
                                    assignButton.prop('disabled', checked === 0);
                                });

                                // Handle assign button click
                                $('.assign-button').on('click', function() {
                                    var selectedSites = $('input[name="selected_sites[]"]:checked').map(function() {
                                        return $(this).val();
                                    }).get();

                                    // Redirect to assign page with the selected IDs as parameters
                                    window.location.href = 'assigntask.php?ids=' + selectedSites.join(',');
                                });
                            });
                        </script>


                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>


<?php include('areaheadfooter.php'); ?>