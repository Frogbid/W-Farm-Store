<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm House | Custome List
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
                        <h5>Customer</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-4">
                                        <strong>Customer List</strong>
                                    </h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-5">
                                                <table class="table table-hover nowrap" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Country Code</th>
                                                            <th>Mobile</th>
                                                            <th>password</th>
                                                            <th>Total Sell Amount</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sel = $con->query("select * from user");
                                                        $i = 0;
                                                        while ($row = $sel->fetch_assoc()) {
                                                            $i = $i + 1;
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $i;
                                                                $id = $row['id'];
                                                                ?></td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><?php echo $row['ccode']; ?></td>
                                                                <td><?php echo $row['mobile']; ?></td>
                                                                <td><?php echo $row['password']; ?></td>
                                                                <td><?php
                                                                    $result = $con->query("SELECT SUM(total) as total FROM `orders` where uid = '$id'")->fetch_assoc();
                                                                    echo $result['total'];
                                                                    ?> BDT</td>
                                                                <td><?php if ($row['status'] == 1) { ?>
                                                                        <a href="?status=0&sid=<?php echo $row['id']; ?>"><button class="btn btn-primary"> Make Premium</button></a>
                                                                    <?php } else { ?>
                                                                        <a href="?status=1&sid=<?php echo $row['id']; ?>"><button class="btn btn-danger"> Make Normal</button></a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a class="danger" href="?dele=<?php echo $row['id']; ?>" data-original-title="" title="">
                                                                        <i class="fa fa-trash-o fa-lg text-danger"></i>
                                                                    </a>
                                                                    &nbsp;&nbsp;
                                                                    <a class="info" href="address.php?uid=<?php echo $row['id']; ?>" data-original-title="" title="">
                                                                        <i class="fa fa-map-marker fa-lg text-info"></i>
                                                                    </a>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['status'])) {
                                $status = $_GET['status'];
                                $id = $_GET['sid'];

                                $con->query("update user set status=" . $status . " where id=" . $id . "");
                                echo '<script type="text/javascript">';
                                echo "setTimeout(function () { swal({title: 'User Status', text: 'User Status Update Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'user.php';});";
                                echo '}, 1000);</script>';
                            }
                            ?>

                            <?php
                            if (isset($_GET['dele'])) {
                            ?>
                                <script type="text/javascript">
                                    setTimeout(function() {
                                        swal({
                                                title: "Are you sure?",
                                                text: "You will not be able to recover this subcategory!",
                                                type: "warning",
                                                showCancelButton: true,
                                                confirmButtonClass: "btn-danger",
                                                confirmButtonText: "Yes, delete it!",
                                                cancelButtonText: "No, cancel!",
                                                closeOnConfirm: false,
                                                closeOnCancel: false
                                            },
                                            function(isConfirm) {
                                                if (isConfirm) {
                                                    <?php $con->query("delete from user where id=" . $_GET['dele'] . ""); ?>
                                                    swal({
                                                        title: 'Customer Delete',
                                                        text: 'Customer Deleted Successfully',
                                                        type: 'error',
                                                        confirmButtonClass: 'btn-danger',
                                                        confirmButtonText: 'OK',
                                                    }, function() {
                                                        window.location = 'user.php';
                                                    });
                                                } else {
                                                    swal({
                                                        title: 'Cancelled',
                                                        text: 'Your customer is safe :)',
                                                        type: 'error',
                                                        confirmButtonClass: 'btn-success',
                                                        confirmButtonText: 'OK',
                                                    }, function() {
                                                        window.location = 'user.php';
                                                    });
                                                }
                                            });
                                    }, 1000);
                                </script>
                            <?php
                            }
                            ?>


                        </div>
                    </div>

                    <?php include('include/footer.php') ?>
                </div>
            </div>
</body>

</html>