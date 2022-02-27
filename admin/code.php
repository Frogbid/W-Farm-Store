<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php echo $fset['title']; ?> | Add Country Code
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
                        <h5>Country Code</h5>
                    </div>
                    <?php
                    if (isset($_GET['edit'])) {
                        $bdata = $con->query("select * from code where id=" . $_GET['edit'] . "")->fetch_assoc();
                    ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 mb-5">
                                                <h4 class="mb-4">
                                                    <strong>Edit Country Code</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="cname">Country Code</label>
                                                        <input type="text" class="form-control" value="<?php echo $bdata['ccode']; ?>" placeholder="Enter Country Code" name="ccode" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cname">Status</label>
                                                        <select class="form-control select2" name="status" required>
                                                            <option value="">Select A Status</option>
                                                            <option value="1" <?php if ($bdata['status'] == 1) {
                                                                                    echo 'selected';
                                                                                } ?>>Active</option>
                                                            <option value="0" <?php if ($bdata['status'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>Deactive</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="edit_product">Update Country Code</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['edit_product'])) {
                            $status = $_POST['status'];
                            $url = $_POST['ccode'];
                            $con->query("update code set status=" . $status . ",ccode='" . $url . "' where id=" . $_GET['edit'] . "");
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Country Code Edit', text: 'Update Country Code Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'clist.php';});";
                            echo '}, 1000);</script>';
                        }
                        ?>

                    <?php } else { ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 mb-5">
                                                <h4 class="mb-4">
                                                    <strong>Add Country Code</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="cname">Country Code</label>
                                                        <input type="text" class="form-control" placeholder="Enter Country Code" name="ccode" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cname">Status</label>
                                                        <select class="form-control select2" name="status" required>
                                                            <option value="">Select A Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Deactive</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="sub_product">Save Country Code</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['sub_product'])) {


                            $status = $_POST['status'];
                            $url = $_POST['ccode'];
                            $con->query("insert into code(`ccode`,`status`)values('" . $url . "'," . $status . ")");
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Country Code Add', text: 'Insert New Country Code Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'code.php';});";
                            echo '}, 1000);</script>';
                        }
                        ?>
                    <?php } ?>
                </div>
            </div>
            <script>
                ;
                (function($) {
                    'use strict'
                    $(function() {
                        $('.dropify').dropify()

                        $('.select2').select2()
                    })

                })(jQuery)
            </script>
            <?php include('include/footer.php') ?>
        </div>
    </div>
</body>

</html>