<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php echo $fset['title']; ?> | Setting
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
                        <h5>Setting</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-lg-12 mb-5">
                                            <h4 class="mb-4">
                                                <strong>Edit Setting</strong>
                                            </h4>
                                            <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">

                                                <?php
                                                $getkey = $con->query("select * from setting")->fetch_assoc();
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="cname">Currency</label>
                                                            <input type="text" id="cname" class="form-control" name="currency" value="<?php echo $getkey['currency']; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                                        <?php
                                                        $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                                                        $limit =  count($tzlist);
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="cname">Select Timezone</label>
                                                            <select name="stime" class="form-control" required>
                                                                <option value="">Select Timezone</option>
                                                                <?php
                                                                for ($k = 0; $k < $limit; $k++) {
                                                                ?>
                                                                    <option <?php echo $tzlist[$k]; ?> <?php if ($tzlist[$k] == $getkey['timezone']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $tzlist[$k]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="cname">Order Min Value</label>
                                                            <input type="text" id="cname" class="form-control" name="omin" value="<?php echo $getkey['o_min']; ?>" required>
                                                        </div>
                                                    </div>




                                                    <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="cname">TAX %</label>
                                                            <input type="text" id="cname" class="form-control" name="tax" value="<?php echo $getkey['tax']; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="cname">Website Title</label>
                                                            <input type="text" id="cname" class="form-control" name="title" value="<?php echo $getkey['title']; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="cname">Website Logo</label>
                                                            <div class="mb-5">
                                                                <input type="file" name="logo" class="dropify" data-height="250" data-validation="[NOTEMPTY]" data-default-file="../<?php echo $getkey['logo']; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="cname">Website Favicon</label>
                                                            <div class="mb-5">
                                                                <input type="file" name="favicon" class="dropify" data-height="250" data-validation="[NOTEMPTY]" data-default-file="../<?php echo $getkey['favicon']; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">Privacy Policy</label>
                                                        <textarea class="form-control summernote" rows="5" name="p_data" style="resize: none;"><?php echo $getkey['privacy_policy']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cname">About Us</label>
                                                        <textarea class="form-control summernote" rows="5" name="a_data" style="resize: none;"><?php echo $getkey['about_us']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                    <div class="form-group">


                                                        <label for="cname">Contact Us</label>
                                                        <textarea class="form-control summernote" rows="5" name="c_data" style="resize: none;"><?php echo $getkey['contact_us']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                    <div class="form-group">


                                                        <label for="cname">Terms & Conditions</label>
                                                        <textarea class="form-control summernote" rows="5" name="terms" style="resize: none;"><?php echo $getkey['terms']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success mr-2 px-5" name="sub_cat">Update Setting</button>
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
                        $title = mysqli_real_escape_string($con, $_POST['title']);
                        $p_data = $_POST['p_data'];
                        $a_data = $_POST['a_data'];
                        $c_data = $_POST['c_data'];
                        $omin = $_POST['omin'];
                        $timezone = $_POST['stime'];
                        $terms = $_POST['terms'];
                        $currency = mysqli_real_escape_string($con, $_POST['currency']);
                        $data = $con->query("select * from setting")->fetch_assoc();
                        if ($_FILES["favicon"]["name"] == '') {
                            $favicon = $data['favicon'];
                        } else {
                            $fileName = $_FILES['favicon']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "website/";
                            $fileExt = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
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

                            $favicon = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                        }


                        if ($_FILES["logo"]["name"] == '') {
                            $logo = $data['logo'];
                        } else {
                            $fileName = $_FILES['logo']['tmp_name'];
                            $sourceProperties = getimagesize($fileName);
                            $resizeFileName = time();
                            $uploadPath = "website/";
                            $fileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
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

                            $logo = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                        }


                        $tax = $_POST['tax'];


                        $con->query("update setting set favicon='" . $favicon . "',logo='" . $logo . "',title='" . $title . "',tax=" . $tax . ",currency='" . $currency . "',privacy_policy='" . $p_data . "',about_us='" . $a_data . "',contact_us='" . $c_data . "',terms='" . $terms . "',o_min=" . $omin . ",`timezone`='" . $timezone . "' where id=1");

                        echo '<script type="text/javascript">';
                        echo "setTimeout(function () { swal({title: 'Update Setting', text: 'Update Setting Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'setting.php';});";
                        echo '}, 1000);</script>';
                    }
                    ?>



                </div>
            </div>
            <script>
                ;
                (function($) {
                    'use strict'
                    $(function() {
                        $('.dropify').dropify()

                        $('.select2').select2()

                        $('.summernote').summernote({
                            height: 250,
                        })
                    })

                })(jQuery)
            </script>

            <?php include('include/footer.php') ?>
        </div>
    </div>
</body>

</html>