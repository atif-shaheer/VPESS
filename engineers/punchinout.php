<?php include('engineersheader.php'); ?>
<script>
        function capturePhoto() {
            // Create a hidden HTML form
            var form = document.createElement('form');
            form.style.display = 'none';
            document.body.appendChild(form);

            // Create an input element to store the captured photo data
            var photoInput = document.createElement('input');
            photoInput.type = 'hidden';
            photoInput.name = 'photoData';
            form.appendChild(photoInput);

            // Create a file input element to trigger the file upload dialog
            var fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.capture = 'camera';
            fileInput.onchange = function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    photoInput.value = reader.result;

                    // Submit the form to a PHP script for further processing
                    form.action = 'save_photo.php';
                    form.method = 'POST';
                    form.submit();
                };
                reader.readAsDataURL(file);
            };
            form.appendChild(fileInput);

            // Simulate a click on the file input element
            fileInput.click();
        }

        function capturePhoto2() {
            // Create a hidden HTML form
            var form = document.createElement('form');
            form.style.display = 'none';
            document.body.appendChild(form);

            // Create an input element to store the captured photo data
            var photoInput = document.createElement('input');
            photoInput.type = 'hidden';
            photoInput.name = 'photoData2';
            form.appendChild(photoInput);

            // Create a file input element to trigger the file upload dialog
            var fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.capture = 'camera';
            fileInput.onchange = function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    photoInput.value = reader.result;

                    // Submit the form to a PHP script for further processing
                    form.action = 'save_photo.php';
                    form.method = 'POST';
                    form.submit();
                };
                reader.readAsDataURL(file);
            };
            form.appendChild(fileInput);

            // Simulate a click on the file input element
            fileInput.click();
        }

        // Function to compress the image blob
        function compressImage(imageBlob, targetSizeInKB) {
            return new Promise(function(resolve) {
                var img = new Image();
                img.src = URL.createObjectURL(imageBlob);
                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    var context = canvas.getContext('2d');
                    
                    var width = img.width;
                    var height = img.height;
                    
                    // Adjust the canvas size based on desired dimensions
                    var maxWidth = 800;
                    var maxHeight = 600;
                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }
                    
                    // Set the canvas size to the adjusted dimensions
                    canvas.width = width;
                    canvas.height = height;
                    
                    // Draw the image onto the canvas with the adjusted dimensions
                    context.drawImage(img, 0, 0, width, height);
                    
                    // Calculate the initial image quality (100%)
                    var initialQuality = 1;
                    
                    // Determine the compression quality based on the target size
                    var targetSizeInBytes = targetSizeInKB * 1024;
                    var compressedSize = imageBlob.size;
                    var compressionRatio = 0.9; // Initial compression ratio
                    var maxIterations = 10;
                    var iterations = 0;
                    
                    while (compressedSize > targetSizeInBytes && iterations < maxIterations) {
                        iterations++;
                        
                        // Adjust the compression ratio
                        compressionRatio *= 0.9;
                        
                        // Convert the canvas content back to a Blob with the updated quality
                        var compressedBlob = canvas.toBlob(function(blob) {
                            return blob;
                        }, 'image/jpeg', initialQuality * compressionRatio);
                        
                        // Update the compressed size
                        compressedSize = compressedBlob.size;
                    }
                    
                    resolve(compressedBlob);
                };
            });
        }

    </script>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <a href="engineersindex.php"><h6 class="h6 mb-0 text-gray-800"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back to home</h6></a> -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Punch In/Out</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <!-- <p style="margin-left:3%;color:black;background-color:yellow;padding:2%;"><b>Note:</b> For Punch out please fill DPR</p> -->
            <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col text-center">
                      <i class="fas fa-sign-in-alt fa-2x text-danger"></i>
                    </div>
                    <div class="col text-center">
                      <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <!-- <a onclick="capturePhoto()" style="color:#5a5c69!important;font-size: 1.11rem;">Punch In</a> -->

                        <?php
                        $currentDate = date("Y-m-d");
                        $employee_code = $_SESSION['employee_code'];
                        $query = "SELECT COUNT(*) as count FROM punchinout WHERE date = '$currentDate' AND employee_code = '$employee_code'";
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        $count = $row['count'];

                        if ($count > 0) {
                            echo '<span style="color: gray;">Punch In</span>';
                        } else {
                            echo '<a onclick="capturePhoto()" style="color:#5a5c69!important;font-size: 1.11rem;">Punch In</a>';
                        }
                        ?>

                    </div>
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

                        <!-- <a onclick="capturePhoto2()" style="color:#5a5c69!important;font-size: 1.11rem;">Punch Out</a> -->

                        <?php
                        $currentDate = date("Y-m-d");

                        // Array of tables
                        $tables = array("goods_item", "installation", "rectification", "service", "ppm", "travelling");

                        // Iterate through each table
                        foreach ($tables as $table) {
                            $sql = "SELECT * FROM $table WHERE date = '$currentDate'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Record exists for the current date
                                echo '
                                <div class="col-xl-4 col-md-4 mb-4" style="width: 50%;">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col text-center">
                                                    <i class="fas fa-sign-out-alt fa-2x text-danger"></i>
                                                </div>
                                                <div class="col text-center">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">    
                                                        <a onclick="capturePhoto2()" style="color:#5a5c69!important;font-size: 1.11rem;">Punch Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                // Exit the loop after finding a match
                                break;
                            }
                        }

                        // Record doesn't exist for the current date in any table
                        if ($result->num_rows == 0) {
                            echo '<script>
                                    function capturePhoto2() {
                                        alert("DPR is not filled, please go and fill it!");
                                        window.location.href = "enggdpr.php";
                                    }
                                  </script>';
                        }
                        ?>



            <!-- <div class="col-xl-4 col-md-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="enggexpenses.php" style="color:#5a5c69!important;">Expenses</a></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <a href="enggexpenses.php"><i class="fas fa-coins fa-2x text-warning"></i></a>
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

          <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Punch Report</h6>
                        <!-- <div class="col-3 col-md-3 col-lg-3">
                            <a href="Travelexp.php" name="submit" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div> -->
                    </div>
                    <div class="table-responsive">
                        <div style="height: 235px;overflow-y:scroll;">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Face</th>
                                        <th>Date</th>
                                        <th>PITime</th>
                                        <th>POTime</th>
                                        <th>TW Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $employee_code = $_SESSION['employee_code'];
                                        $query = "SELECT filename, date, pitime, potime, TIMEDIFF(potime, pitime) AS hours FROM punchinout WHERE 
                                        employee_code = '$employee_code' ORDER BY date desc";
                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            $uploadDir = '../uploadfiles/';
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td><img src="' . $uploadDir . $row['filename'] . '" width="50" height="60"></td>';
                                                echo '<td>' . $row['date'] . '</td>';
                                                echo '<td>' . $row['pitime'] . '</td>';
                                                echo '<td>' . $row['potime'] . '</td>';
                                                echo '<td>' . $row['hours'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="4">No data found</td></tr>';
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
        <!---Container Fluid-->


<?php include('engineersfooter.php'); ?>