<?php include('../include/dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    <?php echo $fset['title']; ?> | 404
  </title>
  <?php include('include/csslist.php') ?>
  <?php include('include/jslist.php') ?>
</head>

<body>
  <div class="air__initialLoading"></div>
<?php
    $getkey = $con->query("select * from setting")->fetch_assoc();
    ?>
  <div class="air__auth">
    <div class="pt-4 pb-4 d-flex align-items-end mt-auto">
      <img src="../<?php echo $getkey['favicon']; ?>" height="35px" alt="AIR UI Logo" />
      <div class="air__utils__logo__text">
        <div class="air__utils__logo__name text-uppercase text-dark font-size-21"><?php echo $getkey['title']; ?></div>
        <div class="air__utils__logo__descr text-uppercase font-size-12 text-gray-6">
          Admin Dashboard
        </div>
      </div>
    </div>
    <div class="air__network__container pl-5 pr-5 pt-5 pb-5 mb-auto text-dark font-size-30">
      <div class="font-weight-bold mb-3">Page not found</div>
      <div>This page is deprecated, deleted, or does not exist at all</div>
      <div class="font-weight-bold font-size-70 mb-1">404 —</div>
      <a href="index.php" class="btn btn-outline-primary width-200">Go Back to Login Page</a>
    </div>
    <?php include('include/loginfooter.php') ?>
  </div>
</body>

</html>