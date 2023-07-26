<?php
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Bottom Navigation Demo</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" media="screen,projection" />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

    #frow {

      margin-top: -10px !important;

    }

    .tabs .indicator {
      height: 5px;
      background-color: #fff;

    }



    /* @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {

  table, thead, tbody, th, td, tr {
    display: block;
  }
  
  thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
  tr {
    margin: 0 0 1rem 0;
  }
  tr:nth-child(odd) {
    background: #ccc;
  }
  td {
    
    border: none;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 50%;
  }
  td:before {
    
    position: absolute;
    
    top: 0;
    left: 6px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
  }


  td:nth-of-type(1):before {
    content: "Site Name";
  }
  td:nth-of-type(2):before {
    content: "Site Id";
  }
  td:nth-of-type(3):before {
    content: "Site Address";
  }
  td:nth-of-type(4):before {
    content: "Job Details";
  }
  td:nth-of-type(5):before {
    content: "Time Frame";
  }
  td:nth-of-type(6):before {
    content: "Work Status";
  }
  td:nth-of-type(7):before {
    content: "Installation Work";
  }
  td:nth-of-type(8):before {
    content: "Remark W"
  }
  td:nth-of-type(9):before {
    content: "Report Format";
  }
  td:nth-of-type(11):before {
    content: "Action";
  }
}     */
  </style>
</head>

<body>

  <header>

    <nav>
      <div class="container">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo">VPESS</a>
          <!-- <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">JavaScript</a></li>
          </ul> -->
        </div>
      </div>
    </nav>

  </header>

  <main>
    <div class="container">
      <div class="row" style="margin-top:20px;">

        <div id="test1" class="col s12">
          <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h4 class="m-0 font-weight-bold text-black" style="background: #ee6e73;color: #fef8fb;padding: 2%;">Ongoing Job</h4>
            </div>

            <div style="height: 446px; overflow-y: scroll;">
              <?php
              $employee_code = $_SESSION['employee_code'];

              $sql = "SELECT DISTINCT customer_work.site_name, work.site_id, customer_work.site_address, customer_work.job_details, work.schedule_date, customer_work.work_status, customer_work.installation_work, customer_work.remark_w 
              FROM customer_work 
              INNER JOIN work ON customer_work.site_id = work.site_id 
              WHERE work.employee_code = '$employee_code' AND customer_work.work_status = 'Ongoing'"; // Adjust the table and column names as per your database structure

              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<table class='table table-bordered'>";
                  echo "<tr><th>Site Name</th><td>" . $row['site_name'] . "</td></tr>";
                  echo "<tr><th>Site ID</th><td>" . $row['site_id'] . "</td></tr>";
                  echo "<tr><th>Site Address</th><td>" . $row['site_address'] . "</td></tr>";
                  echo "<tr><th>Job Details</th><td>" . $row['job_details'] . "</td></tr>";
                  echo "<tr><th>Schedule Date</th><td>" . $row['schedule_date'] . "</td></tr>";
                  echo "<tr><th>Work Status</th><td><a class='btn btn-primary' href='upenggrpt.php?employee_code=" . $row["site_id"] . "'>Job Started</a></td></tr>";
                  // echo "<tr><th>Installation Work</th><td>" . $row['installation_work'] . "</td></tr>";
                  // echo "<tr><th>Remark</th><td>" . $row['remark_w'] . "</td></tr>";
                  echo "</table>";
                  echo "<hr style='border: solid;'>";
                }
              } else {
                echo "<p>No data found for the selected employee.</p>";
              }
              ?>

              <!-- <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>Site Name</th>
                        <th>Site ID</th>
                        <th>Site Address</th>
                        <th>Job Details</th>
                        <th>Time Frame</th>
                        <th>Work Status</th>
                        <th>Installation Work</th>
                        <th>Remark W</th>
                    </tr>
                    </thead>
                    <tbody>

                   <?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                      $username = $_SESSION['username'];
                      $employee_code = $_SESSION['employee_code'];
                    }
                    //$query = "SELECT * FROM customer_work WHERE ahusername = '$username'";
                    $query = "SELECT customer_work.id, customer_work.site_id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                        customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, engineers.work_status, 
                        engineers.installation_work, area_head.username as auser, engineers.remark_w, engineers.report_format, engineers.report_format_pdf FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                        customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND engineers.employee_code = $employee_code AND engineers.work_status = 'Ongoing'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['site_name'] . "</td>";
                        echo "<td>" . $row['site_id'] . "</td>";
                        echo "<td>" . $row['site_address'] . "</td>";
                        echo "<td>" . $row['job_details'] . "</td>";
                        echo "<td>" . $row['time_frame'] . "</td>";
                        echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "' class='btn btn-info'><i class='fa fa-wrench' aria-hidden='true'></i></a></td>";
                        echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "' class='btn btn-info'><i class='fa fa-wrench' aria-hidden='true'></i></a></td>";
                        echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "' class='btn btn-info'><i class='fa fa-check' aria-hidden='true'></i></a></td>";
                        // echo "<td>" . $row['username'] . "</td>";
                        // echo "<td>" .$row['employee_code'] ."</td>";
                        // echo "<td>" .$row['type'] ."</td>";

                        // echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "'>" .$row['work_status'] ."</a></td>";

                        // echo "<td>";
                        // echo "<form action='workboard.php' method='post'>";
                        // echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        // echo "<select name='work_status' onchange='this.form.submit()'>";
                        // echo "<option value='Pending' " . (($row['work_status'] == 'Pending') ? 'selected' : '') . ">Pending</option>";
                        // echo "<option value='In Progress' " . (($row['work_status'] == 'In Progress') ? 'selected' : '') . ">In Progress</option>";
                        // echo "<option value='Completed' " . (($row['work_status'] == 'Completed') ? 'selected' : '') . ">Completed</option>";
                        // echo "</select>";
                        // echo "</form>";
                        // echo "</td>";


                        // echo "<td>";
                        // echo "<form action='workboard.php' method='post'>";
                        // echo "<input type='text' name='id' value='" . $row["work_status"] . "' readonly>";
                        // echo "<select name='work_status' onchange='this.form.submit()'>";
                        // echo "<option value='Ongoing' " . (($row['work_status'] == 'Ongoing') ? 'selected' : '') . "> " . $row['work_status'] . "</option>";
                        // echo "<option value='Ongoing' " . (($row['work_status'] == 'Ongoing') ? 'selected' : '') . ">Ongoing</option>";
                        // echo "<option value='Completed' " . (($row['work_status'] == 'Completed') ? 'selected' : '') . ">Completed</option>";
                        // echo "<option value='Hardware' " . (($row['work_status'] == 'Hardware') ? 'selected' : '') . ">Hardware</option>";
                        // echo "<option value='Client Dependency' " . (($row['work_status'] == 'Client Dependency') ? 'selected' : '') . ">Client Dependency</option>";
                        // echo "</select>";
                        // echo "</form>";
                        // echo "</td>";

                        // echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "'>" .$row['installation_work'] ."</a></td>";
                        // echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "'>" .$row['remark_w'] ."</a></td>";

                        // echo "<td><a href='upenggrpt.php?employee_code=" . $row["employee_code"] . "'>" . $row['report_format'] . "</a></td>";
                        // echo "<td><img src='../uploadsfiles/" . $row['report_format'] . "' width='100'></td>";

                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='6'>No Ongoing Job</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>             -->
            </div>
          </div>
        </div>


        <div id="test2" class="col s12">
          <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h4 class="m-0 font-weight-bold text-black">Completed Job</h4>
            </div>
            <div style="height: 446px; overflow-y: scroll;">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Site Name</th>
                    <th>Site ID</th>
                    <th>Site Address</th>
                    <th>Job Details</th>
                    <th>Time Frame</th>
                    <th>Work Status</th>
                    <th>Installation Work</th>
                    <th>Remark W</th>
                    <th>Report Format</th>
                    <th>Report Format PDF</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  session_start();
                  if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $employee_code = $_SESSION['employee_code'];
                  }
                  //$query = "SELECT * FROM customer_work WHERE ahusername = '$username'";
                  $query = "SELECT customer_work.id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                        customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, engineers.work_status, 
                        engineers.installation_work, area_head.username as auser, engineers.remark_w, engineers.report_format, engineers.report_format_pdf FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                        customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND engineers.employee_code = $employee_code AND engineers.work_status = 'Completed'";
                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['site_name'] . "</td>";
                      echo "<td>" . $row['site_id'] . "</td>";
                      echo "<td>" . $row['site_address'] . "</td>";
                      echo "<td>" . $row['job_details'] . "</td>";
                      echo "<td>" . $row['time_frame'] . "</td>";
                      // echo "<td>" . $row['username'] . "</td>";
                      // echo "<td>" .$row['employee_code'] ."</td>";
                      // echo "<td>" .$row['type'] ."</td>";
                      echo "<td>" . $row['work_status'] . "</td>";
                      echo "<td>" . $row['installation_work'] . "</td>";
                      echo "<td>" . $row['remark_w'] . "</td>";
                      echo "<td>";
                      $images = explode(',', $row['report_format']);
                      $count = 0;
                      foreach ($images as $image) {
                        if ($count < 1) {
                          echo "<img src='../uploadfiles/$image' width='50' height='50'>";
                          $count++;
                        }
                      }
                      echo "</td>";
                      echo "<td>" . $row['report_format_pdf'] . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    //echo "<tr><td colspan='6'>No Job Completed</td></tr>";
                  }
                  ?>

                  <?php
                  session_start();
                  if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $employee_code = $_SESSION['employee_code'];
                  }
                  //$query = "SELECT * FROM customer_work WHERE ahusername = '$username'";
                  $query = "SELECT customer_work.id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                        customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, engineers.work_status, 
                        engineers.installation_work, area_head.username as auser, engineers.remark_w, engineers.report_format, engineers.report_format_pdf FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                        customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND engineers.employee_code = $employee_code AND engineers.work_status = 'Client Dependency'";
                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['site_name'] . "</td>";
                      echo "<td>" . $row['site_id'] . "</td>";
                      echo "<td>" . $row['site_address'] . "</td>";
                      echo "<td>" . $row['job_details'] . "</td>";
                      echo "<td>" . $row['time_frame'] . "</td>";
                      // echo "<td>" . $row['username'] . "</td>";
                      // echo "<td>" .$row['employee_code'] ."</td>";
                      // echo "<td>" .$row['type'] ."</td>";
                      echo "<td>" . $row['work_status'] . "</td>";
                      echo "<td>" . $row['installation_work'] . "</td>";
                      echo "<td>" . $row['remark_w'] . "</td>";
                      echo "<td>";
                      $images = explode(',', $row['report_format']);
                      $count = 0;
                      foreach ($images as $image) {
                        if ($count < 1) {
                          echo "<img src='../uploadfiles/$image' width='50' height='50'>";
                          $count++;
                        }
                      }
                      echo "</td>";
                      echo "<td>" . $row['report_format_pdf'] . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    //echo "<tr><td colspan='6'>No Job Completed</td></tr>";
                  }
                  ?>

                  <?php
                  session_start();
                  if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $employee_code = $_SESSION['employee_code'];
                  }
                  //$query = "SELECT * FROM customer_work WHERE ahusername = '$username'";
                  $query = "SELECT customer_work.id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                        customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, engineers.work_status, 
                        engineers.installation_work, area_head.username as auser, engineers.remark_w, engineers.report_format, engineers.report_format_pdf FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                        customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND engineers.employee_code = $employee_code AND engineers.work_status = 'Hardware'";
                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['site_name'] . "</td>";
                      echo "<td>" . $row['site_id'] . "</td>";
                      echo "<td>" . $row['site_address'] . "</td>";
                      echo "<td>" . $row['job_details'] . "</td>";
                      echo "<td>" . $row['time_frame'] . "</td>";
                      // echo "<td>" . $row['username'] . "</td>";
                      // echo "<td>" .$row['employee_code'] ."</td>";
                      // echo "<td>" .$row['type'] ."</td>";
                      echo "<td>" . $row['work_status'] . "</td>";
                      echo "<td>" . $row['installation_work'] . "</td>";
                      echo "<td>" . $row['remark_w'] . "</td>";
                      echo "<td>";
                      $images = explode(',', $row['report_format']);
                      $count = 0;
                      foreach ($images as $image) {
                        if ($count < 1) {
                          echo "<img src='../uploadfiles/$image' width='50' height='50'>";
                          $count++;
                        }
                      }
                      echo "</td>";
                      echo "<td>" . $row['report_format_pdf'] . "</td>";
                      echo "</tr>";
                    }
                  } else {
                    //echo "<tr><td colspan='6'>No Job Completed</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div id="test3" class="col s12">
          <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h4 class="m-0 font-weight-bold text-black" style="background: #ee6e73;color: #fef8fb;padding: 2%;">Pending Job</h4>
            </div>
            <div style="height: 446px; overflow-y: scroll;">
              <?php
              //   if (isset($_GET['work_status'])) {
              //   $id = $_GET['work_status']; 
              //   $checked = "Pending";
              //   if ($checked == "Pending") {
              //     $sql = "UPDATE engineers SET work_status='Ongoing' WHERE site_id='$id'";
              //     $result = mysqli_query($conn, $sql);
              //       if ($result) {
              //         echo "<script>alert('You Have Successfully Picked Up The Job Please Check Next In Ongoing Job..!');window.location.href='workboard.php';</script>";
              //       }
              //     }
              //  }
              ?>

              <?php
              $employee_code = $_SESSION['employee_code'];

              $sql = "SELECT DISTINCT customer_work.site_name, work.site_id, customer_work.site_address, customer_work.job_details, work.schedule_date, customer_work.work_status, customer_work.installation_work, customer_work.remark_w 
        FROM customer_work 
        INNER JOIN work ON customer_work.site_id = work.site_id 
        WHERE work.employee_code = '$employee_code' AND customer_work.work_status = 'Pending'"; // Adjust the table and column names as per your database structure

              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<table class='table table-bordered'>";
                  echo "<tr><th>Site Name</th><td>" . $row['site_name'] . "</td></tr>";
                  echo "<tr><th>Site ID</th><td>" . $row['site_id'] . "</td></tr>";
                  echo "<tr><th>Site Address</th><td>" . $row['site_address'] . "</td></tr>";
                  echo "<tr><th>Job Details</th><td>" . $row['job_details'] . "</td></tr>";
                  echo "<tr><th>Schedule Date</th><td>" . $row['schedule_date'] . "</td></tr>";
                  echo "<tr><th>Work Status</th><td><a class='btn btn-primary' href='workboard.php?work_status=" . $row["site_id"] . "'>Start Job</a></td></tr>";
                  echo "<tr><th>Installation Work</th><td>" . $row['installation_work'] . "</td></tr>";
                  // echo "<tr><th>Remark</th><td>" . $row['remark_w'] . "</td></tr>";
                  echo "</table>";
                  echo "<hr style='border: solid;'>";

                  // Check if the "Start Job" button is clicked
                  if (isset($_GET['work_status']) && $_GET['work_status'] == $row["site_id"]) {
                    // Update the work status to "Ongoing"
                    $updateSql = "UPDATE customer_work SET work_status = 'Ongoing' WHERE site_id = '" . $row["site_id"] . "'";
                    $updateResult = mysqli_query($conn, $updateSql);

                    if ($updateResult) {
                      echo "<script>alert('Your job has been successfully started please check briefcase..!');window.location.href='workboard.php';</script>";
                    } else {
                      echo "<p>Failed to update work status.</p>";
                    }
                  }
                }
              } else {
                echo "<p>No data found for the selected employee.</p>";
              }
              ?>


              <!-- <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>Site Name</th>
                        <th>Site ID</th>
                        <th>Site Address</th>
                        <th>Job Details</th>
                        <th>Time Frame</th>
                        <th>Work Status</th>
                        <th>Installation Work</th>
                        <th>Remark W</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    session_start();
                    if (isset($_SESSION['username'])) {
                      $username = $_SESSION['username'];
                      $employee_code = $_SESSION['employee_code'];
                    }
                    //$query = "SELECT * FROM customer_work WHERE ahusername = '$username'";
                    $query = "SELECT customer_work.id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                        customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, engineers.work_status, 
                        engineers.installation_work, area_head.username as auser, engineers.remark_w FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                        customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND engineers.employee_code = $employee_code AND engineers.work_status = 'Pending'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['site_name'] . "</td>";
                        echo "<td>" . $row['site_id'] . "</td>";
                        echo "<td>" . $row['site_address'] . "</td>";
                        echo "<td>" . $row['job_details'] . "</td>";
                        echo "<td>" . $row['time_frame'] . "</td>";
                        // echo "<td>" . $row['username'] . "</td>";
                        // echo "<td>" .$row['employee_code'] ."</td>";
                        // echo "<td>" .$row['type'] ."</td>";
                        echo "<td><a href='workboard.php?work_status=" . $row["site_id"] . "'>Pick Job</a></td>";
                        echo "<td>" . $row['installation_work'] . "</td>";
                        echo "<td>" . $row['remark_w'] . "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='6'>No Pending Jobs</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>             -->
            </div>
          </div>
        </div>

        <div id="test4" class="col s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Your Reward <i class="material-icons right">more_vert</i> </span>
              <!-- <p><a href="#">This is a link</a></p> -->
            </div>
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="https://cdn.dribbble.com/users/2234115/screenshots/11583807/media/39534133c0e0166e67cc858e1e7cde34.png?compress=1&resize=400x300">
            </div>
            <!-- <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
              <p><a href="#">This is a link</a></p>
            </div> -->
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4">Your Reward<i class="material-icons right">close</i></span>
              <p>You need to do more hard work..!</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>

  <footer class="page-footer">
    <div class="row" id="frow" style="margin-bottom:0px;">
      <div class="col s12" style="padding-left:0px!important;padding-right:0px!important;">
        <ul class="tabs tabs-fixed-width transparent white-text">
          <li class="tab col s3 white-text"><a href="#test1" class="active white-text"><i class="material-icons">work</i></a></li>
          <li class="tab col s3"><a href="#test2" class="white-text"><i class="material-icons">check_circle</i></a></li>
          <li class="tab col s3"><a href="#test3" class="white-text"><i class="material-icons">schedule</i></a></li>
          <li class="tab col s3"><a href="#test4" class="white-text"><i class="material-icons">emoji_events</i></a></li>
        </ul>
      </div>
    </div>

  </footer>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</body>

</html>