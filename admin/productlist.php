<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Product List
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
                        <h5>Product</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-4">
                                        <strong>Product List</strong>
                                    </h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-5">
                                                <table class="table table-hover nowrap" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Product Name</th>
                                                            <th class="text-center">Product Image</th>
                                                            <th class="text-center">Product Related Image</th>
                                                            <th>Seller Name</th>
                                                            <th>Category Name</th>
                                                            <th>SubCategory Name</th>
                                                            <th>Small Description</th>
                                                            <th>Product Range</th>
                                                            <th>Product Price</th>
                                                            <th>In Stock ?</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $jj = $con->query("select * from product order by id desc");
                                                        $i = 0;
                                                        while ($rkl = $jj->fetch_assoc()) {
                                                            $i = $i + 1;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $rkl['pname']; ?></td>
                                                                <td class="text-center"><img src="../<?php echo $rkl['pimg']; ?>" width="100" height="100" /></td>
                                                                <td class="text-center"><?php $sb = explode(',', $rkl['prel']);


                                                                                        foreach ($sb as $bb) {
                                                                                            if ($bb == '') {
                                                                                            } else {
                                                                                        ?>
                                                                            <img src="../<?php echo $bb; ?>" width="100" height="100" />
                                                                    <?php
                                                                                            }
                                                                                        }
                                                                    ?></td>
                                                                <td><?php echo $rkl['sname']; ?></td>

                                                                <td><?php $cat = $con->query("select * from category where id=" . $rkl['cid'] . "")->fetch_assoc();
                                                                    echo $cat['catname']; ?></td>
                                                                <td><?php $cat = $con->query("select * from subcategory where id=" . $rkl['sid'] . "")->fetch_assoc();
                                                                    echo $cat['name']; ?></td>
                                                                <td><?php echo substr($rkl['psdesc'], 0, 100) . '....'; ?></td>
                                                                <td><?php echo str_replace('$;', ', ', $rkl['pgms']); ?></td>
                                                                <td><?php echo str_replace('$;', ', ', $rkl['pprice']); ?></td>
                                                                <td><?php if ($rkl['stock'] == 1) {
                                                                        echo 'Yes';
                                                                    } else {
                                                                        echo 'No';
                                                                    } ?></td>
                                                                <td><?php if ($rkl['status'] == 1) {
                                                                        echo 'Publish';
                                                                    } else {
                                                                        echo 'Unpublish';
                                                                    } ?></td>
                                                                <td class="text-center">
                                                                    <a class="primary" href="product.php?edit=<?php echo $rkl['id']; ?>" data-original-title="" title="">
                                                                        <i class="fa fa-pencil-square-o fa-lg text-info"></i>&nbsp;
                                                                    </a>

                                                                    <a class="danger" data-original-title="" href="?dele=<?php echo $rkl['id']; ?>" title="">
                                                                        <i class="fa fa-trash-o fa-lg text-danger"></i>
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
                            if (isset($_GET['dele'])) {

                            ?>
                                <script type="text/javascript">
                                    setTimeout(function() {
                                        swal({
                                                title: "Are you sure?",
                                                text: "You will not be able to recover this product!",
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
                                                    <?php $con->query("delete from product  where id=" . $_GET['dele'] . ""); ?>
                                                    swal({
                                                        title: 'Product Delete',
                                                        text: 'Product Deleted Successfully',
                                                        type: 'error',
                                                        confirmButtonClass: 'btn-danger',
                                                        confirmButtonText: 'OK',
                                                    }, function() {
                                                        window.location = 'productlist.php';
                                                    });
                                                } else {
                                                    swal({
                                                        title: 'Cancelled',
                                                        text: 'Your product is safe :)',
                                                        type: 'error',
                                                        confirmButtonClass: 'btn-success',
                                                        confirmButtonText: 'OK',
                                                    }, function() {
                                                        window.location = 'productlist.php';
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