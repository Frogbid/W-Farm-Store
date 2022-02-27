<?php include('../include/dbconfig.php') ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Dashboard
    </title>
    <?php include('include/csslist.php') ?>
    <?php include('include/jslist.php') ?>
</head>

<body class="air__menu--gray">
<div class="air__initialLoading"></div>
<div class="air__layout air__layout--hasSider">
    <?php include('include/sidebar.php') ?>
    <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
    <div class="air__layout">
        <?php include('include/topbar.php') ?>
        <div class="air__layout--contentNoMaxWidth">
            <div class="air__utils__content">
                <div class="air__utils__heading">
                    <h5>Dashboard</h5>
                </div>
                <?php
                if ($username == 0) {
                ?>
                <div class="row">
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Total Category
                                        </p>
                                    </div>
                                    <p class="text-success font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from category")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Total Subcategory
                                        </p>
                                    </div>
                                    <p class="text-primary font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from subcategory")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Total Product
                                        </p>
                                    </div>
                                    <p class="text-danger font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from product")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Total Customer
                                        </p>
                                    </div>
                                    <p class="text-success font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from user")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Pending Order
                                        </p>
                                    </div>
                                    <p class="text-primary font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from orders where status='pending'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Complete Order
                                        </p>
                                    </div>
                                    <p class="text-danger font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from orders where status='completed'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Canceled Order
                                        </p>
                                    </div>
                                    <p class="text-success font-weight-bold font-size-24 mb-0">
                                        <?php echo $con->query("select * from orders where status='cancelled'")->num_rows; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="mr-auto">
                                        <p class="text-uppercase text-dark font-weight-bold mb-1">
                                            Total Sales
                                        </p>
                                    </div>
                                    <p class="text-success font-weight-bold font-size-24 mb-0">
                                        <?php $sales = $con->query("select sum(total) as full_total from orders where status='completed'")->fetch_assoc();

                                        if ($sales['full_total'] == '') {
                                            echo 0;
                                        } else {
                                            echo $sales['full_total'];
                                        } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }else if( $username == 1 ){
                    ?>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mr-auto">
                                            <p class="text-uppercase text-dark font-weight-bold mb-1">
                                                Total Category
                                            </p>
                                        </div>
                                        <p class="text-success font-weight-bold font-size-24 mb-0">
                                            <?php echo $con->query("select * from category")->num_rows; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mr-auto">
                                            <p class="text-uppercase text-dark font-weight-bold mb-1">
                                                Total Subcategory
                                            </p>
                                        </div>
                                        <p class="text-primary font-weight-bold font-size-24 mb-0">
                                            <?php echo $con->query("select * from subcategory")->num_rows; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mr-auto">
                                            <p class="text-uppercase text-dark font-weight-bold mb-1">
                                                Total Product
                                            </p>
                                        </div>
                                        <p class="text-danger font-weight-bold font-size-24 mb-0">
                                            <?php echo $con->query("select * from product")->num_rows; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="row">

                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mr-auto">
                                            <p class="text-uppercase text-dark font-weight-bold mb-1">
                                                Pending Order
                                            </p>
                                        </div>
                                        <p class="text-primary font-weight-bold font-size-24 mb-0">
                                            <?php echo $con->query("select * from orders where status='pending'")->num_rows; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mr-auto">
                                            <p class="text-uppercase text-dark font-weight-bold mb-1">
                                                Complete Order
                                            </p>
                                        </div>
                                        <p class="text-danger font-weight-bold font-size-24 mb-0">
                                            <?php echo $con->query("select * from orders where status='completed'")->num_rows; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="mr-auto">
                                            <p class="text-uppercase text-dark font-weight-bold mb-1">
                                                Canceled Order
                                            </p>
                                        </div>
                                        <p class="text-success font-weight-bold font-size-24 mb-0">
                                            <?php echo $con->query("select * from orders where status='cancelled'")->num_rows; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
}
?>

                </div>
            </div>

            <?php include ('include/footer.php') ?>
        </div>
    </div>
</body>

</html>