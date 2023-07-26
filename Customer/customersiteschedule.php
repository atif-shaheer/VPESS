<?php include('customerheader.php'); ?>

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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Site Schedule</h6>
                </div>

                <script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            editable: false,
            events: [
                <?php
                // Retrieve data from the "work" table
                $sql = "SELECT * FROM work";
                $result = mysqli_query($conn, $sql);

                // Check if there are any rows in the result set
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each row in the result set
                    while ($row = mysqli_fetch_assoc($result)) {
                        $siteId = $row['site_id'];
                        $scheduleDate = $row['schedule_date'];

                        // Convert the schedule_date to the required format (e.g., YYYY-MM-DD)
                        $formattedDate = date('Y-m-d', strtotime($scheduleDate));

                        // Generate the JavaScript event object
                        echo "{ 
                            title: 'Site ID: $siteId',
                            start: '$formattedDate',
                            url: 'get_panel_content.php?siteId=$siteId',
                            className: 'site-link'
                        },";
                    }
                }
                ?>
            ],
            eventClick: function (calEvent, jsEvent, view) {
                if (calEvent.url) {
                    // Open the panel or perform any other desired action
                    window.location.href = calEvent.url;
                }
            }
        });
    });
</script> 

<div id="calendar" class="p-4"></div>


                <!-- <div class="container">
                    <div id="calendar">
                    <div class="calendar-header">
                        <button id="prev-month-btn">&lt;</button>
                        <h2 id="calendar-month-year"></h2>
                        <button id="next-month-btn">&gt;</button>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-dates"></div>
                    </div>
                    </div>
                </div> -->
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>


<?php include('customerfooter.php'); ?>