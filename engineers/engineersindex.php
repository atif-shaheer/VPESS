<?php include('engineersheader.php'); ?>

<?php
session_start(); // start the session

// check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["employee_code"])) {
  header("Location: engineerslogin.php");
  exit();
}
?>

<!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div> -->

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">

                    <div class="col text-center">
                      <i class="fas fa-user-clock fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;"><a href="punchinout.php" style="color:#5a5c69!important;font-size: 1.11rem;">Punch In/Out</a></div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i>
                        34
                        </span>
                        <span>Since last month</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <i class="fas fa-envelope fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;">
<a href="https://login.microsoftonline.com/common/oauth2/authorize?client_id=00000002-0000-0ff1-ce00-000000000000&redirect_uri=https%3a%2f%2foutlook.office.com%2fowa%2f&resource=00000002-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code+id_token&scope=openid&msafed=1&msaredir=1&client-request-id=c7783024-65bd-7115-2351-c7344d7b809b&protectedtoken=true&claims=%7b%22id_token%22%3a%7b%22xms_cc%22%3a%7b%22values%22%3a%5b%22CP1%22%5d%7d%7d%7d&nonce=638217986236133043.ab1fcbbf-5e8d-41d2-823d-6deddacaab46&state=Dcu9DoIwFEDhou_iVukPlHYgDhrDgAuaaNju7S0JRIIBgvHt7fCd7SSMsX20ixIRwwqjrZKFs0ZpI7UWmT4Cys4jdjwPlngmSXGrNHFDgQg8AGYmie8lnb6QnpYV1lDKwxyon4NfH1MJVSN8dTP1z230ahZUbq5HN7bje2jv-YBKbPi8fvBs_w&sso_reload=true" style="color:#5a5c69!important;font-size: 1.11rem;">

                        Mail Box
</a>
                      </div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>
                        56
                        </span>
                        <span>Since last month</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col text-center">
                      <i class="fas fa-phone-square fa-2x text-warning"></i>
                    </div>
                    <div class="col mr-2 text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;"><a href="enggTsprt.php" style="color:#5a5c69!important;font-size: 1.11rem;">Technical Support</a></div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <i class="fas fa-briefcase fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;">Over Time</div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <i class="fas fa-bell fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;">Reminder</div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <i class="fas fa-list-alt fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;"><a href="enggdpr.php" style="color:#5a5c69!important;font-size: 1.11rem;">DPR</a></div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">

                    <div class="col text-center">
                      <i class="fas fa-hand-holding-usd fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;">Investment</div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <i class="fas fa-paper-plane fa-2x text-warning"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="font-size: 1.11rem;">Request</div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <a href="enggexpenses.php"><i class="fas fa-coins fa-2x text-warning"></i></a>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="enggexpenses.php" style="color:#5a5c69!important;font-size: 1.11rem;">Expenses</a></div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col text-center">
                      <a href="engineerslogout.php"><i class="fas fa-sign-out-alt fa-2x text-warning"></i></a>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="engineerslogout.php" style="color:#5a5c69!important;font-size: 1.11rem;">Logout</a></div>
                      <!-- <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div> -->
                    </div>

                  </div>
                </div>
              </div>
            </div>

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

<?php include('engineersfooter.php'); ?>