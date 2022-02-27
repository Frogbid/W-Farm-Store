<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Subcategory
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
                    <?php if (isset($_GET['edit'])) {
                        $sels = $con->query("select * from subcategory where id=" . $_GET['edit'] . "");
                        $sels = $sels->fetch_assoc();
                    ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 mb-5">
                                                <h4 class="mb-4">
                                                    <strong>Edit Subcategory</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="form-label">Select A Category</label>
                                                        <select name="scat" class="form-control select2" data-validation="[NOTEMPTY]" required>
                                                            <option value="0">Select A Category</option>
                                                            <?php
                                                            $sel = $con->query("select * from category");
                                                            while ($rs = $sel->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $rs['id']; ?>" <?php if ($rs['id'] == $sels['cat_id']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo $rs['catname']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Subcategory Name</label>
                                                        <input name="cname" value="<?php echo $sels['name']; ?>" type="text" class="form-control" data-validation="[NOTEMPTY]" required />
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Subcategory Image</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="f_up" class="dropify" data-height="300" data-validation="[NOTEMPTY]" data-default-file="../<?php echo $sels['img']; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="up_cat">Update Subcategory</button>
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
                            $cname = mysqli_real_escape_string($con, $_POST['cname']);
                            $cid = $_POST['scat'];

                            if (!empty($_FILES["f_up"]["name"])) {


                                $fileName = $_FILES['f_up']['tmp_name'];
                                $sourceProperties = getimagesize($fileName);
                                $resizeFileName = time();
                                $uploadPath = "subcategory/";
                                $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);
                                $uploadImageType = $sourceProperties[2];
                                $sourceImageWidth = $sourceProperties[0];
                                $sourceImageHeight = $sourceProperties[1];
                                $new_width = $sourceImageWidth;
                                $new_height = $sourceImageHeight;
                                switch ($uploadImageType) {
                                    case IMAGETYPE_JPEG:
                                        $resourceType = imagecreatefromjpeg($fileName);
                                        $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                        imagejpeg($imageLayer, '../' . $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                        break;

                                    case IMAGETYPE_GIF:
                                        $resourceType = imagecreatefromgif($fileName);
                                        $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                        imagegif($imageLayer, '../' . $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                        break;

                                    case IMAGETYPE_PNG:

                                        $resourceType = imagecreatefrompng($fileName);
                                        $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                        imagepng($imageLayer, '../' . $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                        break;

                                    default:
                                        $imageProcess = 0;
                                        break;
                                }

                                $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                                $con->query("update subcategory set name='" . $cname . "',img='" . $url . "',cat_id=" . $cid . " where id=" . $_GET['edit'] . "");
                            } else {
                                $con->query("update subcategory set name='" . $cname . "',cat_id=" . $cid . " where id=" . $_GET['edit'] . "");
                            }
                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Subcategory Edit', text: 'Subcategory Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'subcategorylist.php';});";
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
                                                    <strong>Add Subcatagory</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="form-label">Select A Category</label>
                                                        <select name="scat" class="form-control select2" data-validation="[NOTEMPTY]" required>
                                                            <option value="0">Select A Category</option>
                                                            <?php
                                                            $sp = $con->query("select * from category");
                                                            while ($roc = $sp->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $roc['id']; ?>"><?php echo $roc['catname']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Subcategory Name</label>
                                                        <input name="cname" type="text" class="form-control" data-validation="[NOTEMPTY]" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Subcategory Image</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="f_up" class="dropify" data-height="300" data-validation="[NOTEMPTY]" required />
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="sub_cat">Save Subcategory</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['sub_cat'])) {
                            $cname = mysqli_real_escape_string($con, $_POST['cname']);
                            $cid = $_POST['scat'];

                            $fileName = $_FILES['f_up']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "subcategory/";
                            $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);
                            $uploadImageType = $sourceProperties[2];
                            $sourceImageWidth = $sourceProperties[0];
                            $sourceImageHeight = $sourceProperties[1];
                            $new_width = $sourceImageWidth;
                            $new_height = $sourceImageHeight;
                            switch ($uploadImageType) {
                                case IMAGETYPE_JPEG:
                                    $resourceType = imagecreatefromjpeg($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagejpeg($imageLayer, '../' . $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                    break;

                                case IMAGETYPE_GIF:
                                    $resourceType = imagecreatefromgif($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagegif($imageLayer, '../' . $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);
                                    break;

                                case IMAGETYPE_PNG:

                                    $resourceType = imagecreatefrompng($fileName);
                                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                                    imagepng($imageLayer, '../' . $uploadPath . "thump_" . $resizeFileName . '.' . $fileExt);

                                    break;

                                default:
                                    $imageProcess = 0;
                                    break;
                            }

                            $url = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            $con->query("insert into subcategory(`cat_id`,`name`,`img`)values(" . $cid . ",'" . $cname . "','" . $url . "')");
                            echo '<script type="text/javascript">';
                            echo
                                "setTimeout(function () { swal({title: 'Subcategory Add', text: 'Subcategory Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'subcategory.php';});";
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