<?php require '../include/dbconfig.php'; ?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Product
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
                    <?php
                    if (isset($_GET['edit'])) {
                        $selk = $con->query("select * from product where id=" . $_GET['edit'] . "")->fetch_assoc();
                    ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 mb-5">
                                                <h4 class="mb-4">
                                                    <strong>Edit Product</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="cname">Product Name</label>
                                                        <input type="text" id="vname" class="form-control" value="<?php echo $selk['pname']; ?>" name="pname" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Product Image</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="pimg" class="dropify" data-height="300" data-validation="[NOTEMPTY]" data-default-file="../<?php echo $selk['pimg']; ?>" />
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="cname">Product Related Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="myInput" name="prel[]" aria-describedby="myInput" multiple>
                                                            <label class="custom-file-label" for="myInput">Choose file</label>
                                                        </div>
                                                        <p>Only Upload 3 Images</p>
                                                        <?php $sb = explode(',', $selk['prel']);


                                                        foreach ($sb as $bb) {
                                                            if ($bb == '') {
                                                            } else {
                                                        ?>
                                                                <img src="../<?php echo $bb; ?>" width="100" height="100" />
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Seller Name / Shop Name</label>
                                                        <input type="text" id="gurl" class="form-control" placeholder="Enter Seller Name" value="<?php echo $selk['sname']; ?>" name="sname" required>

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput6">Select Category</label>
                                                        <select id="cat_change" name="catname" class="form-control select2" required>

                                                            <?php
                                                            $j = mysqli_fetch_assoc(mysqli_query($con, "select * from category where id=" . $selk['cid'] . ""));
                                                            ?>
                                                            <option value="<?php echo $j['id']; ?>"><?php echo $j['catname']; ?></option>
                                                            <?php
                                                            $sk = mysqli_query($con, "select * from category where id !=" . $selk['cid'] . "");
                                                            while ($h = mysqli_fetch_assoc($sk)) {
                                                            ?>
                                                                <option value="<?php echo $h['id']; ?>"><?php echo $h['catname']; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput6">Select SubCategory</label>
                                                        <select id="sub_list" name="subcatname" class="form-control select2" required>

                                                            <?php
                                                            $j = mysqli_fetch_assoc(mysqli_query($con, "select * from subcategory where id=" . $selk['sid'] . " and cat_id=" . $selk['cid'] . ""));
                                                            ?>
                                                            <option value="<?php echo $j['id']; ?>"><?php echo $j['name']; ?></option>
                                                            <?php
                                                            $sk = mysqli_query($con, "select * from subcategory where id !=" . $selk['sid'] . " and cat_id=" . $selk['cid'] . "");
                                                            while ($h = mysqli_fetch_assoc($sk)) {
                                                            ?>
                                                                <option value="<?php echo $h['id']; ?>"><?php echo $h['name']; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput6">Out OF Stock?</label>
                                                        <select id="projectinput68" name="ostock" class="form-control select2" required>

                                                            <option <?php if ($selk['stock'] == 0) {
                                                                        echo 'selected';
                                                                    } ?> value="0">Yes</option>
                                                            <option <?php if ($selk['stock'] == 1) {
                                                                        echo 'selected';
                                                                    } ?> value="1">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput6">Product Publish Or Unpublish?</label>
                                                        <select id="projectinput67" name="ppuborun" class="form-control select2">

                                                            <option value="0" <?php if ($selk['status'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>Unpublish</option>
                                                            <option <?php if ($selk['status'] == 1) {
                                                                        echo 'selected';
                                                                    } ?> value="1">Publish</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput6">Make Product Popular?</label>
                                                        <select id="projectinput6" name="popular" class="form-control select2">

                                                            <option value="0" <?php if ($selk['popular'] == 0) {
                                                                                    echo 'selected';
                                                                                } ?>>No</option>
                                                            <option <?php if ($selk['popular'] == 1) {
                                                                        echo 'selected';
                                                                    } ?> value="1">Yes</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="gurl">Product Small Description</label>
                                                        <textarea class="form-control" name="psdesc" placeholder="Enter Product Small Description" required><?php echo $selk['psdesc']; ?></textarea>

                                                    </div>


                                                    <div class="form-group">
                                                        <label for="gurl">Product (Gms,kg,ltr,ml,pcs)</label>
                                                        <input type="text" id="ptype" class="form-control" name="pgms" value="<?php echo str_replace('$;', ',', $selk['pgms']); ?>" data-role="tagsinput" required>
                                                        <p>After write Product Type Press Enter</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Product Price</label>
                                                        <input type="text" id="pprice" class="form-control" name="pprice" value="<?php echo str_replace('$;', ',', $selk['pprice']); ?>" required>
                                                        <p>After write Product Price Press Enter</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Product discount(Only Digit)</label>
                                                        <input type="text" id="gurl" class="form-control" name="discount_percentage" placeholder="Enter discount in percentage" value="<?php echo $selk['discount']; ?>" required>

                                                    </div>


                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="edit_product">Update Product</button>
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
                            $data = $con->query("select * from product where id=" . $_GET['edit'] . "")->fetch_assoc();
                            $pname = mysqli_real_escape_string($con, $_POST['pname']);
                            $sname = $_POST['sname'];
                            $popular = $_POST['popular'];
                            $discount = $_POST['discount_percentage'];
                            $catname = $_POST['catname'];
                            $subcatname = $_POST['subcatname'];
                            $ostock = $_POST['ostock'];
                            $snoti = $_POST['snoti'];
                            $psdesc = mysqli_real_escape_string($con, $_POST['psdesc']);
                            $pgms = str_replace(',', '$;', $_POST['pgms']);
                            $pprice = str_replace(',', '$;', $_POST['pprice']);

                            $timestamp = date("Y-m-d H:i:s");
                            $status = $_POST['ppuborun'];

                            if ($_FILES["pimg"]["name"] == '') {
                                $pimg = $data['pimg'];
                            } else {
                                $fileName = $_FILES['pimg']['tmp_name'];
                                echo $_FILES['pimg']['name'];
                                $sourceProperties = getimagesize($fileName);
                                $resizeFileName = uniqid() . time();
                                $uploadPath = "cat/";
                                $fileExt = pathinfo($_FILES['pimg']['name'], PATHINFO_EXTENSION);
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

                                $pimg = $uploadPath . "thump_" . $resizeFileName . "." . $fileExt;
                            }


                            if (empty($_FILES['prel']['name'][0])) {
                                $related = $data['prel'];
                            } else {
                                $arr = array();
                                foreach ($_FILES['prel']['tmp_name'] as $key => $tmp_name) {
                                    $file_name = $key . $_FILES['prel']['name'][$key];
                                    $file_size = $_FILES['prel']['size'][$key];
                                    $file_tmp = $_FILES['prel']['tmp_name'][$key];

                                    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                    if (
                                        $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
                                        && $file_type != "gif"
                                    ) {
                                        $related = '';
                                    } else {

                                        move_uploaded_file($file_tmp, '../' . "cat/" . $file_name);
                                        $arr[] = "cat/" . $file_name;
                                    }
                                }
                                $related = implode(',', $arr);
                            }

                            if ($related == '') {
                                $related = $data['prel'];
                            }


                            $con->query("update product set pname='" . $pname . "',sname='" . $sname . "',pimg='" . $pimg . "',prel='" . $related . "',popular=" . $popular . ",discount=" . $discount . ",cid=" . $catname . ",sid=" . $subcatname . ",psdesc='" . $psdesc . "',pgms='" . $pgms . "',pprice='" . $pprice . "',status=" . $status . ",stock=" . $ostock . " where id=" . $_GET['edit'] . "");


                            echo '<script type="text/javascript">';
                            echo "setTimeout(function () { swal({title: 'Product Edit', text: 'Product Edited Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'productlist.php';});";
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
                                                    <strong>Add Product</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="cname">Product Name</label>
                                                        <input type="text" id="vname" class="form-control" placeholder="Enter Product Name" name="pname" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label">Product Image</label>
                                                        <div class="mb-5">
                                                            <input type="file" name="pimg" class="dropify" data-height="300" data-validation="[NOTEMPTY]" required />
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cname">Product Related Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="myInput" name="prel[]" aria-describedby="myInput" multiple>
                                                            <label class="custom-file-label" for="myInput">Choose file</label>
                                                        </div>
                                                        <p>Only Upload 3 Images</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Seller Name / Shop Name</label>
                                                        <input type="text" id="gurl" class="form-control" placeholder="Enter Seller Name" name="sname" required>

                                                    </div>



                                                    <div class="form-group">
                                                        <label for="projectinput6">Select Category</label>
                                                        <select id="cat_change" name="catname" class="form-control select2" required>
                                                            <option value="" selected="" disabled="">Select Category</option>
                                                            <?php
                                                            $sk = mysqli_query($con, "select * from category");
                                                            while ($h = mysqli_fetch_assoc($sk)) {
                                                            ?>
                                                                <option value="<?php echo $h['id']; ?>"><?php echo $h['catname']; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput6">Select SubCategory</label>
                                                        <select id="sub_list" name="subcatname" class="form-control select2" required>
                                                            <option value="" selected="" disabled="">Select SubCategory</option>


                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="projectinput67">Out OF Stock?</label>
                                                        <select id="projectinput67" name="ostock" class="form-control select2">

                                                            <option value="0">Yes</option>
                                                            <option selected="" value="1">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput68">Product Publish Or Unpublish?</label>
                                                        <select id="projectinput68" name="ppuborun" class="form-control select2">

                                                            <option value="0">Unpublish</option>
                                                            <option selected="" value="1">Publish</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="projectinput69">Make Product Popular?</label>
                                                        <select id="projectinput69" name="popular" class="form-control select2">

                                                            <option value="1">Yes</option>
                                                            <option selected="" value="0">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Product Small Description</label>
                                                        <textarea class="form-control" name="psdesc" placeholder="Enter Product Small Description" required></textarea>

                                                    </div>



                                                    <div class="form-group">
                                                        <label for="gurl">Product (Gms,kg,ltr,ml,pcs)</label>
                                                        <input type="text" id="ptype" class="form-control" name="pgms" value="1 gms,250 gms" data-role="tagsinput" required>
                                                        <p>After write Product Type Press Enter</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Product Price</label>
                                                        <input type="text" id="pprice" class="form-control" value="1,10" name="pprice" data-role="tagsinput" required>
                                                        <p>After write Product Price Press Enter</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gurl">Product discount (Only Digit)</label>
                                                        <input type="text" id="gurl" class="form-control" name="discount_percentage" placeholder="Enter discount in percentage ex. 5" required>

                                                    </div>

                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="save_product">Save Product</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php
                        if (isset($_POST['save_product'])) {
                            if (count($_FILES['prel']['name']) > 3) {
                                echo '<script type="text/javascript">';
                                echo "setTimeout(function () { swal({title: 'Product Add', text: 'Sorry Only Allow 3 Images', type: 'error', confirmButtonClass: 'btn-danger', confirmButtonText: 'OK', },function() {window.location = 'product.php';});";
                                echo '}, 1000);</script>';
                            } else {
                                $pname = mysqli_real_escape_string($con, $_POST['pname']);
                                $sname = $_POST['sname'];
                                $catname = $_POST['catname'];
                                $subcatname = $_POST['subcatname'];
                                $ostock = $_POST['ostock'];
                                $snoti = $_POST['snoti'];
                                $psdesc = mysqli_real_escape_string($con, $_POST['psdesc']);
                                $pgms = str_replace(',', '$;', $_POST['pgms']);
                                $popular = $_POST['popular'];
                                $pprice = str_replace(',', '$;', $_POST['pprice']);

                                $timestamp = date("Y-m-d H:i:s");
                                $status = $_POST['ppuborun'];
                                $discount = $_POST['discount_percentage'];

                                $fileName = $_FILES['pimg']['tmp_name'];
                                $sourceProperties = getimagesize($fileName);
                                $resizeFileName = time();
                                $uploadPath = "cat/";
                                $fileExt = pathinfo($_FILES['pimg']['name'], PATHINFO_EXTENSION);
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
                                if (!empty($_FILES['prel']['name'][0])) {
                                    $arr = array();
                                    foreach ($_FILES['prel']['tmp_name'] as $key => $tmp_name) {
                                        $file_name = $key . $_FILES['prel']['name'][$key];
                                        $file_size = $_FILES['prel']['size'][$key];
                                        $file_tmp = $_FILES['prel']['tmp_name'][$key];

                                        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                        if (
                                            $file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
                                            && $file_type != "gif"
                                        ) {
                                            $related = '';
                                        } else {

                                            move_uploaded_file($file_tmp, '../' . "cat/" . $file_name);
                                            $arr[] = "cat/" . $file_name;
                                        }
                                    }
                                    $related = implode(',', $arr);
                                } else {
                                    $related = '';
                                }
                                $con->query("insert into product(`pname`,`pimg`,`prel`,`sname`,`cid`,`sid`,`psdesc`,`pgms`,`pprice`,`date`,`status`,`stock`,`discount`,`popular`) values('" . $pname . "','" . $url . "','" . $related . "','" . $sname . "'," . $catname . "," . $subcatname . ",'" . $psdesc . "','" . $pgms . "','" . $pprice . "','" . $timestamp . "'," . $status . "," . $ostock . "," . $discount . "," . $popular . ")");

                                echo '<script type="text/javascript">';
                                echo
                                    "setTimeout(function () { swal({title: 'Product Add', text: 'Product Added Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'product.php';});";
                                echo '}, 1000);</script>';
                            }
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

                /* show file value after file select */
                document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                    var files = $(this)[0].files;
                    var fileName = document.getElementById("myInput").files[0].name;
                    for (i = 1; i < files.length; i++) {
                        fileName = fileName + ',' + document.getElementById("myInput").files[i].name;
                    }
                    var nextSibling = e.target.nextElementSibling
                    nextSibling.innerText = fileName
                })
            </script>
            <script>
                $('#ptype').tagsInput({
                    'delimiter': ','
                });
                $('#pprice').tagsInput({
                    'delimiter': ','
                });
            </script>
            <script>
                $(document).on('change', '#cat_change', function() {
                    var value = $(this).val();

                    $.ajax({
                        type: 'post',
                        url: 'getsub.php',
                        data: {
                            catid: value
                        },
                        success: function(data) {
                            $('#sub_list').html(data);
                        }
                    });
                });
            </script>
            <?php include('include/footer.php') ?>
        </div>
    </div>
</body>

</html>