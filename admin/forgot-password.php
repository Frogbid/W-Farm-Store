<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Air UI Admin Template (Html Edition)
        Air UI HTML Admin Template
    </title>
    <?php include('include/csslist.php') ?>
    <?php include('include/jslist.php') ?>
</head>

<body>
    <div class="air__initialLoading"></div>

    <div class="air__auth">
        <div class="pt-5 pb-5 d-flex align-items-end mt-auto">
            <img src="../components/core/img/air-logo.png" alt="AIR UI Logo" />
            <div class="air__utils__logo__text">
                <div class="air__utils__logo__name text-uppercase text-dark font-size-21">AIR UI</div>
                <div class="air__utils__logo__descr text-uppercase font-size-12 text-gray-6">
                    Admin template
                </div>
            </div>
        </div>
        <div class="air__auth__container pl-5 pr-5 pt-5 pb-5 bg-white text-center">
            <div class="text-dark font-size-30 mb-4">Reset Password</div>
            <form action="#" class="mb-4">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Email Address" />
                </div>
                <button class="text-center btn btn-success w-100 font-weight-bold font-size-18">
                    Reset my password
                </button>
            </form>
        </div>
        <div class="text-center font-size-18 pt-4 mb-auto">
            <a href="index.php" class="font-weight-bold text-blue"><i class="fe fe-arrow-left align"></i> Go Back</a>
        </div>
        <?php include('include/loginfooter.php') ?>
    </div>
</body>

</html>