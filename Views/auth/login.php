<?php
require_once '../../Models/User.php';
require_once '../../Controllers/AuthController.php';
$errMsg = "";

if (isset($_GET["logout"])) {
  session_start();
  session_destroy();
}
if (isset($_POST['email']) && isset($_POST['password'])) {
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = new User;
    $auth = new AuthController;
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    if (!$auth->login($user)) {
      if (!isset($_SESSION["userId"])) {
        session_start();
      }
      $errMsg = $_SESSION["errMsg"];
    } else {
      if (!isset($_SESSION["userId"])) {
        session_start();
      }
      if ($_SESSION["userRole"] == "admin") {
        header("location: ../admin/index.php");
      } else {
        header("location: ../customer/index.php");
      }

    }


  } else {
    $errMsg = "Please fill all fields";
  }
}

?>

<!DOCTYPE html>


<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Login </title>

  <meta name="description" content="" />

  <!-- Favicon -->

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body style="background-color: #F4F5F8;">
  <!-- Content -->

  <div class="container-xxl ">
    <div class="authentication-wrapper authentication-basic container-p-y ">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card " style="background-color: #4E73DF; color: #fff;">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            </div>
            <!-- /Logo -->
            <h4 class="mb-2" style="color: #fff;">Welcome to Bug Tracker App! 👋</h4>

            <?php

            if ($errMsg != "") {
              ?>
              <div class="alert alert-danger" role="alert"><?php echo $errMsg ?></div>
              <?php
            }

            ?>



            <form id="formAuthentication" class="mb-3" action="login.php" method="POST">
              <div class="mb-3">
                <label for="email" style="color: #fff;" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
                  autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label style="color: #fff;" class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>

            <p class="text-center">
              <span>New on our platform?</span>
              <a style="color: #59b3e0;" href="register.php">
                <span>Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script>
  <script src="../assets/js/main.js"></script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>