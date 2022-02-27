<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Subcategory List
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
                        <h5>Subcategory</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-4">
                                        <strong>Subcategory List</strong>
                                    </h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-5">
                                                <table class="table table-hover nowrap" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Category Name</th>
                                                            <th>SubCategory Name</th>
                                                            <th class="text-center">SubCategory Image</th>
                                                            <th>Total Product</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sel = $con->query("select * from subcategory");
                                                        $i = 0;
                                                        while ($row = $sel->fetch_assoc()) {
                                                            $i = $i + 1;
                                                        ?>
                                                            <tr>

                                                                <td><?php echo $i; ?></td>
                                                                <td><?php $cname = $con->query("select * from category where id=" . $row['cat_id'] . "")->fetch_assoc();
                                                                    echo $cname['catname']; ?>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td class="text-center"><img class="media-object round-media" src="../<?php echo $row['img']; ?>" alt="Generic placeholder image" style="height: 75px;"></td>
                                                                <td><?php echo $con->query("select * from product where sid=" . $row['id'] . "")->num_rows; ?></td>
                                                                <td class="text-center">
                                                                    <a class="primary" href="subcategory.php?edit=<?php echo $row['id']; ?>" data-original-title="" title="">
                                                                        <i class="fa fa-pencil-square-o fa-lg text-info"></i>&nbsp;
                                                                    </a>

                                                                    <a class="danger" href="?dele=<?php echo $row['id']; ?>" data-original-title="" title="">
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
                                                    <?php $con->query("delete from subcategory where id=" . $_GET['dele'] . ""); ?>
                                                    swal({
                                                        title: 'Subcategory Delete',
                                                        text: 'Subcategory Deleted Successfully',
                                                        type: 'error',
                                                        confirmButtonClass: 'btn-danger',
                                                        confirmButtonText: 'OK',
                                                    }, function() {
                                                        window.location = 'subcategorylist.php';
                                                    });
                                                } else {
                                                    swal({
                                                        title: 'Cancelled',
                                                        text: 'Your subcategory is safe :)',
                                                        type: 'error',
                                                        confirmButtonClass: 'btn-success',
                                                        confirmButtonText: 'OK',
                                                    }, function() {
                                                        window.location = 'subcategorylist.php';
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