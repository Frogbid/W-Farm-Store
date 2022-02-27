<?php require '../include/dbconfig.php';
$getkey = $con->query("select * from setting")->fetch_assoc();

?>
<?php include('include/session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        Farm Store | Pending Order
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
                        <h5>Order</h5>
                    </div>
                    <?php
                    if (isset($_GET['oid'])) {
                        $odata = $con->query("select * from orders where id=" . $_GET['oid'] . "")->fetch_assoc();
                    ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 mb-5">
                                                <h4 class="mb-4">
                                                    <strong>Assign Deliveryboy</strong>
                                                </h4>
                                                <form id="form-validation-simple" name="form-validation-simple" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="cname">Select Delivery Boy</label>
                                                        <select name="srider" class="form-control select2" required>
                                                            <option value="">Select a Delivery Boy</option>
                                                            <?php
                                                            $rid = $con->query("select * from rider where a_status=1 and status=1");
                                                            while ($ro = $rid->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $ro['id']; ?>" <?php if ($ro['id'] == $odata['rid']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?php echo $ro['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" style="display:none;">
                                                        <label for="cname">Pickup Address</label>
                                                        <textarea class="form-control" name="pickup" required>Surat Gujrat</textarea>
                                                    </div>

                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success mr-2 px-5" name="as_order">Assign Delivery Boy</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['as_order'])) {

                            $rid = $_POST['srider'];
                            $pickup = $_POST['pickup'];
                            $id = $_GET['oid'];
                            $check = $con->query("select * from orders where id=" . $id . "")->fetch_assoc();
                            if ($check['r_status'] != 'Accepted') {
                                $timestamp = date("Y-m-d H:i:s");
                                $con->query("update orders set rid=" . $rid . ",pickup='" . $pickup . "',a_status=1,r_status='Assigned' where id=" . $id . "");
                                $con->query("insert into rnoti(`rid`,`msg`,`date`)values(" . $rid . ",'You have an order assigned to you.','" . $timestamp . "')");
                                $content = array(
                                    "en" => 'You have an order assigned to you.' //mesaj burasi
                                );
                                $fields = array(
                                    'app_id' => r_key,
                                    'included_segments' =>  array("Active Users"),
                                    'filters' => array(array('field' => 'tag', 'key' => 'rider_id', 'relation' => '=', 'value' => $rid)),
                                    'contents' => $content
                                );
                                $fields = json_encode($fields);


                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                                curl_setopt(
                                    $ch,
                                    CURLOPT_HTTPHEADER,
                                    array(
                                        'Content-Type: application/json; charset=utf-8',
                                        'Authorization: Basic ' . r_hash
                                    )
                                );
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                                curl_setopt($ch, CURLOPT_POST, TRUE);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

                                $response = curl_exec($ch);
                                curl_close($ch);

                                echo '<script type="text/javascript">';
                                echo "setTimeout(function () { swal({title: 'Assign Delivery Boy', text: 'Assign Delivery Boy Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'order.php';});";
                                echo '}, 1000);</script>';
                            } else {
                                echo '<script type="text/javascript">';
                                echo "setTimeout(function () { swal({title: 'Assign Delivery Boy', text: 'Assign Delivery Boy Already Accepted Order So Can not Change Delivery Boy', type: 'error', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'order.php';});";
                                echo '}, 1000);</script>';
                            }
                        }
                        ?>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4">
                                            <strong>Pending Order List</strong>
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-5">
                                                    <table class="table table-hover nowrap" id="example1">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr No.</th>
                                                                <th>Date</th>
                                                                <th>Order ID</th>
                                                                <th>Status</th>
                                                                <th>Preview</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sel = $con->query("select * from orders where status !='completed' order by id desc");
                                                            $i = 0;
                                                            while ($row = $sel->fetch_assoc()) {

                                                                $i = $i + 1;
                                                            ?>
                                                                <tr>

                                                                    <td><?php echo $i; ?></td>
                                                                    <td><?php echo $row['order_date']; ?></td>

                                                                    <td><?php echo $row['id']; ?></td>
                                                                    <td><?php echo ucfirst($row['status']); ?></td>
                                                                    <td>
                                                                        <button class="preview_d btn btn-primary shadow-z-2" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#myModal">Preview</button>
                                                                    </td>

                                                                    <td>
                                                                        <?php if ($row['p_method'] == 'Pickup Myself' and $row['status'] != 'completed' and $row['status'] != 'cancelled') { ?>
                                                                            <a href="?status=completed&id=<?php echo $row['id']; ?>"><button class="btn shadow-z-2 btn-success">Make Completed</button></a>
                                                                        <?php } ?>
                                                                        <a href="?dele=<?php echo $row['id']; ?>"><button class="btn shadow-z-2 btn-danger gradient-pomegranate">Delete</button></a>
                                                                    </td>

                                                                </tr>
                                                            <?php  } ?>
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
                                    $id = $_GET['id'];

                                    $con->query("update orders set status='" . $status . "' where id=" . $id . "");
                                    echo '<script type="text/javascript">';
                                    echo "setTimeout(function () { swal({title: 'Deliveryboy Status', text: 'Delivery Boy Status Update Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'order.php';});";
                                    echo '}, 1000);</script>';
                                }
                                if (isset($_GET['dele'])) {

                                ?>
                                    <script type="text/javascript">
                                        setTimeout(function() {
                                            swal({
                                                    title: "Are you sure?",
                                                    text: "You will not be able to recover this order!",
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
                                                        <?php
                                                        $con->query("delete from orders where id=" . $_GET['dele'] . ""); ?>
                                                        swal({
                                                            title: 'Order Delete',
                                                            text: 'Selected order Deleted Successfully',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-danger',
                                                            confirmButtonText: 'OK',
                                                        }, function() {
                                                            window.location = 'order.php';
                                                        });
                                                    } else {
                                                        swal({
                                                            title: 'Cancelled',
                                                            text: 'Order is safe :)',
                                                            type: 'error',
                                                            confirmButtonClass: 'btn-success',
                                                            confirmButtonText: 'OK',
                                                        }, function() {
                                                            window.location = 'order.php';
                                                        });
                                                    }
                                                });
                                        }, 1000);
                                    </script>
                                <?php
                                }
                                ?>
                                <?php
                                if (isset($_GET['status'])) {
                                    $status = $_GET['status'];
                                    $id = $_GET['rid'];

                                    $con->query("update rider set status=" . $status . " where id=" . $id . "");
                                    echo '<script type="text/javascript">';
                                    echo "setTimeout(function () { swal({title: 'Deliveryboy Status', text: 'Delivery Boy Status Update Successfully', type: 'success', confirmButtonClass: 'btn-success', confirmButtonText: 'OK', },function() {window.location = 'riderlist.php';});";
                                    echo '}, 1000);</script>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">


                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Order Preivew</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body p_data">

                                </div>

                            </div>

                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $("#example1").on("click", ".preview_d", function() {
                                var id = $(this).attr('data-id');
                                $.ajax({
                                    type: 'post',
                                    url: 'pdata.php',
                                    data: {
                                        pid: id
                                    },
                                    success: function(data) {
                                        $(".p_data").html(data);
                                    }
                                });
                            });
                        });
                    </script>
                    <script>
                        function printDiv() {

                            var divToPrint = document.getElementById('divprint');

                            var newWin = window.open('', 'Print-Window');
                            var htmlToPrint = '' +
                                '<style type="text/css">' +
                                'table th, table td {' +
                                'border:1px solid #000;' +
                                'padding:0.5em;' +
                                '}' +
                                '.list-group { ' +
                                ' display: flex; ' +
                                ' flex-direction: column; ' +
                                ' padding-left: 0; ' +
                                ' margin-bottom: 0; ' +
                                '}' +
                                '.list-group-item {' +
                                ' position: relative;' +
                                'display: block;' +
                                'padding: 0.75rem 1.25rem;' +
                                'margin-bottom: -1px;' +
                                'background-color: #fff;' +
                                'border: 1px solid rgba(0, 0, 0, 0.125);' +
                                '}' +

                                '.float-right {' +
                                'float: right !important;' +
                                '}' +

                                '</style>';

                            newWin.document.open();
                            htmlToPrint += divToPrint.innerHTML;
                            newWin.document.write('<html><body onload="window.print()">' + htmlToPrint + '</body></html>');

                            newWin.document.close();

                            setTimeout(function() {
                                newWin.close();
                            }, 1);

                        }
                    </script>
                    <?php include('include/footer.php') ?>
                </div>
            </div>
</body>

</html>