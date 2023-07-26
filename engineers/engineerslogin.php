<?php
include('../config.php');
?>

<?php
session_start();
if(isset($_POST['engineerslogin'])) {
  $employee_code = mysqli_real_escape_string($conn, $_POST['employee_code']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $query = "SELECT * FROM engineers WHERE employee_code = '$employee_code' AND password = '$password'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
    
    // Set the session variables
    $_SESSION['employee_code'] = $data['employee_code'];
    $_SESSION['username'] = $data['username'];
    // $_SESSION['area'] = $data['area'];
    header('Location: engineersindex.php');
  } else {
    echo "<script>alert('Invalid employee code or password.!');window.location.href='engineerslogin.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../assets/img/Capture-removebg-preview-removebg-preview (1).png" rel="icon">
  <title>Engineers - Login</title>
  <link href="../assets2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets2/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <img src="../CEO/Capture-removebg-preview-removebg-preview (1).png"
                      style="width:30%;padding-bottom: 10%;">
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input name="employee_code" type="text" class="form-control" id="employee_code"
                        aria-describedby="employee_codeHelp" placeholder="Enter Employee Code">
                    </div>
                    <div class="form-group">
                      <input id="password" name="password" type="password" class="form-control"
                        placeholder="Password">
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <button type="submit" name="engineerslogin" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="register.html">Create an Account!</a>
                  </div> -->
                    <div class="text-center">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="../assets2/vendor/jquery/jquery.min.js"></script>
  <script src="../assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets2/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets2/js/ruang-admin.min.js"></script>
</body>

</html>