<?php
include('../config.php');
session_start();
// header("location:mindex.php");
?>

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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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



    <title>Small Calendar</title>

    <style>
      .fade-in {
          opacity: 0;
          transition: opacity 2.5s;
      }

      .fade-in.show {
          opacity: 1;
      }
    </style>
</head>

<body>

<div id="calendar"></div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- FullCalendar JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

</body>

</html>
