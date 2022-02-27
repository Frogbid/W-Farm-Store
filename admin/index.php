<?php include('../include/dbconfig.php');
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    Farm Store | Login
  </title>
  <?php include('include/csslist.php') ?>
  <?php include('include/jslist.php') ?>
</head>

<body>
  <div class="air__initialLoading"></div>
  <div class="air__auth">
    <div class="pt-5 pb-5 d-flex align-items-end mt-auto">
      <img src="" height="35px" alt="AIR UI Logo" />
      <div class="air__utils__logo__text">
        <div class="air__utils__logo__name text-uppercase text-dark font-size-21">Farm Store</div>
        <div class="air__utils__logo__descr text-uppercase font-size-12 text-gray-6">
          Admin Dashboard
        </div>
      </div>
    </div>
    <div class="air__auth__container pl-5 pr-5 pt-5 pb-5 bg-white text-center">
      <div class="text-dark font-size-30 mb-4">Log In</div>
      <form action="" class="mb-4" method="post">
        <div class="form-group mb-4">
          <input type="text" class="form-control" name="inputEmail" placeholder="Email Address" required />
        </div>
        <div class="form-group mb-4">
          <input type="password" name="inputPass" id="password" class="form-control" placeholder="Password" required />
        </div>
        <button type="submit" class="text-center btn btn-success w-100 font-weight-bold font-size-18" name="sub_log">
          Log In
        </button>
      </form>
      <?php
      if (isset($_POST['sub_log'])) {

        $email =mysqli_real_escape_string($con, $_POST['inputEmail']);
        $pass = mysqli_real_escape_string($con,$_POST['inputPass']);

        $sel = $con->query("select * from admin where username='" . $email . "' and password='" . $pass . "'")->num_rows;

        if ($sel != 0) {
          $_SESSION['username'] = $email;
      ?>
          <script>
            window.location.href = "dashboard.php";
          </script>
        <?php
        } else {
        ?>
          <script>
            alert('email address and password wrong!');
          </script>
      <?php
        }
      }
      ?>
      <!--<a href="forgot-password.php" class="text-blue font-weight-bold font-size-18">Forgot password?</a>-->
    </div>
    <script>
                ;
                (function($) {
                    'use strict'
                    $(function() {
                        $('.dropify').dropify()

                        $('.select2').select2()
                        
                        $('#password').password({
        eyeClass: '',
        eyeOpenClass: 'fe fe-eye',
        eyeCloseClass: 'fe fe-eye-off',
      })
                    })

                })(jQuery)
            </script>
    <!--<div class="text-center font-size-18 pt-4 mb-auto">
      Don't have an account?
      <a href="signup.php" class="font-weight-bold text-blue text-underlined"><u>Sign Up</u></a>
    </div>-->
    <?php include('include/loginfooter.php') ?>
  </div>
</body>

</html>