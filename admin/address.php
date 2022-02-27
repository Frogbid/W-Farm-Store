<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php echo $fset['title']; ?> | Address
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
                        <h5>Area</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-4">
                                        <strong>Customer Address</strong>
                                    </h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-5">
                                                <table class="table table-hover nowrap" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Name</th>
                                                            <th>House No.</th>
                                                            <th>Society</th>
                                                            <th>Area</th>
                                                            <th>Pincode</th>
                                                            <th>Landmark</th>

                                                            <th>Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sel = $con->query("select * from address where uid=" . $_GET['uid'] . "");
                                                        $i = 0;
                                                        while ($row = $sel->fetch_assoc()) {
                                                            $i = $i + 1;
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['hno']; ?></td>
                                                                <td><?php echo $row['society']; ?></td>
                                                                <td><?php echo $row['area']; ?></td>
                                                                <td><?php echo $row['pincode']; ?></td>
                                                                <td><?php echo $row['landmark']; ?></td>

                                                                <td><?php echo $row['type']; ?></td>


                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>

                    <?php include('include/footer.php') ?>
                </div>
            </div>
</body>

</html>