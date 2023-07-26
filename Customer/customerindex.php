<?php include('customerheader.php'); ?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["c_id"])) {
  header("Location: customerlogin.php");
  exit();
}
?>

<!-- PHP code to query database and count work_status -->
<?php
if(isset($_POST['site_id'])) {
    $site_id = $_POST['site_id'];
    $pending_count = 0;
    $ongoing_count = 0;
    $completed_count = 0;

    $sql = "SELECT work_status FROM customer_work WHERE site_id = '$site_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row['work_status'] == 'Pending') {
                $pending_count++;
            } elseif($row['work_status'] == 'Ongoing') {
                $ongoing_count++;
            } elseif($row['work_status'] == 'Completed') {
                $completed_count++;
            }
        }
    }
}

// Pass the counts to the Donut Chart
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="customerindex.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div> -->

  <div class="row">
    <div class="col-lg-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <!-- <h6 class="m-0 font-weight-bold text-primary">Site Report</h6> -->
          <div class="col-12 col-md-12 col-lg-12">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="input-group">
                  <input type="text" id="site_id" name="site_id" class="form-control" placeholder="Please Enter Site Id" required>
                  <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                  </div>
                </div>
            </form>
          </div>
          <!-- <form method="POST">
              <input type="text" id="site_id" name="site_id">
              <input type="submit" value="Search">
          </form> -->
        </div>
        <div class="card-body">
          <div class="chart-pie pt-0">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div class=""></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
              </div>
            </div>
            <canvas id="work_status_chart" width="462" height="506" style="display: block; width: 231px; height: 253px;" class="chartjs-render-monitor"></canvas>
          </div>
          <!-- <hr>
                    Styling for the donut chart can be found in the <code>/js/demo/chart-pie-demo.js</code> file. -->
        </div>
      </div>
    </div>
<!-- JavaScript code for Donut Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('work_status_chart').getContext('2d');
    var workStatusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Ongoing', 'Completed'],
            datasets: [{
                label: 'Work Status',
                data: [<?php echo $pending_count; ?>, <?php echo $ongoing_count; ?>, <?php echo $completed_count; ?>],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(75, 192, 192)'
                ]
            }]
        },
        options: {}
    });
</script>

<div class="col-lg-9 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Task Report</h6>
                    <div class="col-3 col-md-3 col-lg-3">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="input-group">
                                <input type="text" name="site_id" class="form-control" placeholder="Please Enter Site Id" required>
                                <div class="input-group-append">
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div class="table-responsive">
                    <div style="height: 367px;overflow-y:scroll;">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Report Format PDF</th>
                                    <th>Report Format</th>
                                    <th>Site Name</th>
                                    <th>Site ID</th>
                                    <th>Site Address</th>
                                    <th>Job Details</th>
                                    <th>Time Frame</th>
                                    <th>Engineer Name</th>
                                    <th>Employee Code</th>
                                    <th>Employee Type</th>
                                    <th>Work Status</th>
                                    <th>Installation Work</th>
                                    <th>Remark W</th>                                  
                                    <th>AHUsername</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['submit'])) {
                                    $site_id = $_POST['site_id'];
                                    $c_id = $_SESSION['c_id'];
                                    $query = "SELECT customer_work.id, customer_work.site_name, engineers.site_id, customer_work.site_address, customer_work.location, customer_work.job_details,
                                    customer_work.time_frame, engineers.username, engineers.employee_code, engineers.type, engineers.work_status, 
                                    customer_work.installation_work, area_head.username as ahusername, engineers.remark_w, engineers.report_format, engineers.report_format_pdf FROM customer_work INNER JOIN engineers INNER JOIN area_head WHERE 
                                    customer_work.site_id = engineers.site_id AND engineers.ausername = area_head.username AND customer_work.site_id = '$site_id' AND c_id = '$c_id'";
                                    $result = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td><a href='../uploadfiles/" . $row['report_format_pdf'] . "' download><i class='fa fa-download'></i></a></td>";
                                            echo "<td>";
                                            $images = explode(',', $row['report_format']);
                                            $count = 0;
                                            foreach ($images as $image) {
                                                if ($count < 1) {
                                                    echo "<a href='download_pdf.php?site_id=" . $row['site_id'] . "' target='_blank'><img src='../uploadfiles/$image' width='50' height='50'></a>";
                                                    $count++;
                                                }
                                            }
                                            echo "</td>";
                                            echo "<td>" . $row['site_name'] . "</td>";
                                            echo "<td>" . $row['site_id'] . "</td>";
                                            echo "<td>" . $row['site_address'] . "</td>";
                                            echo "<td>" . $row['job_details'] . "</td>";
                                            echo "<td>" . $row['time_frame'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['employee_code'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['work_status'] . "</td>";
                                            echo "<td>" . $row['installation_work'] . "</td>";
                                            echo "<td>" . $row['remark_w'] . "</td>";
                                            //echo "<td>" . $row['report_format'] . "</td>";
                                            echo "<td>" . $row['ahusername'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "No results found for site ID: $site_id";
                                    }
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

  <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div> -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">Pending Work</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i>
                  34
                </span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-cog fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-4 col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div> -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">Ongoing Work</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-warning mr-2"><i class="fas fa-arrow-up"></i>
                  56
                </span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-cog fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div> -->
              <div class="h5 mb-0 font-weight-bold text-gray-800">Completed Work</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                  56
                </span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-cog fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- Pending Requests Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

    <!-- Area Chart -->
    <!-- <div class="col-xl-8 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- Pie Chart -->
    <!-- <div class="col-xl-4 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Month <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Select Periode</div>
                      <a class="dropdown-item" href="#">Today</a>
                      <a class="dropdown-item" href="#">Week</a>
                      <a class="dropdown-item active" href="#">Month</a>
                      <a class="dropdown-item" href="#">This Year</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <div class="small text-gray-500">Oblong T-Shirt
                      <div class="small float-right"><b>600 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Gundam 90'Editions
                      <div class="small float-right"><b>500 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Rounded Hat
                      <div class="small float-right"><b>455 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Indomie Goreng
                      <div class="small float-right"><b>400 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Remote Control Car Racing
                      <div class="small float-right"><b>200 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <a class="m-0 small text-primary card-link" href="#">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div> -->
    <!-- Invoice Example -->
    <!-- <div class="col-xl-8 col-lg-7 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="#">RA0449</a></td>
                        <td>Udin Wayang</td>
                        <td>Nasi Padang</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA5324</a></td>
                        <td>Jaenab Bajigur</td>
                        <td>Gundam 90' Edition</td>
                        <td><span class="badge badge-warning">Shipping</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA8568</a></td>
                        <td>Rivat Mahesa</td>
                        <td>Oblong T-Shirt</td>
                        <td><span class="badge badge-danger">Pending</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA1453</a></td>
                        <td>Indri Junanda</td>
                        <td>Hat Rounded</td>
                        <td><span class="badge badge-info">Processing</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td><a href="#">RA1998</a></td>
                        <td>Udin Cilok</td>
                        <td>Baby Powder</td>
                        <td><span class="badge badge-success">Delivered</span></td>
                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div> -->
    <!-- Message From Customer-->
    <!-- <div class="col-xl-4 col-lg-5 ">
              <div class="card">
                <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
                </div>
                <div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                        problem I've been having.</div>
                      <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a href="#">
                      <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                      </div>
                      <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                      </div>
                      <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                        ducimus qui blanditiis
                      </div>
                      <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
                    </a>
                  </div>
                  <div class="card-footer text-center">
                    <a class="m-0 small text-primary card-link" href="#">View More <i
                        class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
              </div>
            </div> -->
  </div>
  <!--Row-->

  <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                  class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
            </div>
          </div> -->

  <!-- Modal Logout -->
  <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div> -->

</div>
<!---Container Fluid-->

<?php include('customerfooter.php'); ?>