<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Catagory
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
                        <h5>Category</h5>
                    </div>
                    <?php if (isset($_GET['edit'])) {
                        $sels = $con->query("select * from category where id=" . $_GET['edit'] . "");
                        $sels = $sels->fetch_assoc();
                    ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 mb-5">
                                                <h4 class="mb-4">
                                                    <strong>Edit Catagory</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="form-label">Category Name</label>
                                                        <input name="Category_Name" type="text" value="<?php echo $sels['catname']; ?>" class="form-control" data-validation="[NOTEMPTY]" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Category Image</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="Category_Image" class="dropify" data-height="300" data-validation="[NOTEMPTY]" data-default-file="../<?php echo $sels['catimg']; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="up_cat">Update Category</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['up_cat'])) {
                            $cname = mysqli_real_escape_string($con, $_POST['Category_Name']);


                            if (!empty($_FILES["Category_Image"]["name"])) {


                                $fileName = $_FILES['Category_Image']['tmp_name'];
                                $sourceProperties = getimagesize($fileName);
                                $resizeFileName = time();
                                $uploadPath = "cat/";
                                $fileExt = pathinfo($_FILES['Category_Image']['name'], PATHINFO_EXTENSION);

                                $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                                if (move_uploaded_file($fileName, '../' . $url)) {
                                    $con->query("update category set catname='" . $cname . "',catimg='" . $url . "' where id=" . $_GET['edit'] . "");
                                }
                            } else {
                                $con->query("update category set catname='" . $cname . "' where id=" . $_GET['edit'] . "");
                            }
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Edit', text: 'Catagory Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'categorylist.php';});";
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
                                                    <strong>Add Catagory</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="form-label">Category Name</label>
                                                        <input name="Category_Name" type="text" class="form-control" data-validation="[NOTEMPTY]" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Category Image</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="Category_Image" class="dropify" data-height="300" data-validation="[NOTEMPTY]" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="sub_cat">Save Category</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <script>
                        ;
                        (function($) {
                            'use strict'
                            $(function() {
                                $('.dropify').dropify()
                            })

                        })(jQuery)
                    </script>
                    <?php
                    if (isset($_POST['sub_cat'])) {
                        $cname = mysqli_real_escape_string($con, $_POST['Category_Name']);

                        $fileName = $_FILES['Category_Image']['tmp_name'];
                        $resizeFileName = time();
                        $uploadPath = "cat/";
                        $fileExt = pathinfo($_FILES['Category_Image']['name'], PATHINFO_EXTENSION);

                        $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                        if (move_uploaded_file($fileName, '../' . $url)) {
                            $con->query("insert into category(`catname`,`catimg`)values('" . $cname . "','" . $url . "')");
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Add', text: 'Catagory Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', });";
                            echo '}, 1000);</script>';
                        } else {
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Catagory Add', text: 'Something went wrong', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', });";
                            echo '}, 1000);</script>';
                        }
                    }

                    ?>


                </div>
            </div>

            <?php include('include/footer.php') ?>
        </div>
    </div>
</body>

</html>