<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
   <!-- Stylesheets/CDN Area Start ============================================= -->
   <?php
   $page = 'index';
   require_once('includes/cdn.php');
   $id = $_GET['id'];
   $sql = "SELECT * FROM product WHERE id = '$id'";
   $result =  mysqli_query($con, $sql);
   $row = mysqli_fetch_array($result);
   ?>
   <!-- Stylesheets/CDN Area End ============================================= -->
</head>

<body class="stretched">
   <!-- Document Wrapper ============================================= -->
   <div id="wrapper" class="clearfix">

      <!-- On LOad Modal Area Start-->
      <?php
      require_once('includes/onloadmodal.php');
      ?>
      <!-- On LOad Modal Area End-->

      <!-- Top Bar Area Start ============================================= -->
      <?php
      require_once('includes/topbar.php');
      ?>
      <!-- Top Bar Area End ============================================= -->

      <!-- Navbar Area Start ============================================= -->
      <?php
      require_once('includes/navbar.php');
      ?>
      <!-- Navbar Area end -->

      <!-- Content ============================================= -->
      <section id="content">
         <div class="content-wrap">
            <div class="container clearfix">
               <!---user password update area start--->
               <div id="message"></div>
               <div>
                  <div class="card shadow">
                     <?php
                     $id = $_GET['id'];
                     $sql = "SELECT * FROM `product`,`category` WHERE product.cid = category.id AND product.id = '$id'";
                     $result =  mysqli_query($con, $sql);
                     $row = mysqli_fetch_array($result);
                     ?>
                     <div class="card-body">
                        <div class="card-header">
                           <h2><?php echo $row['pname']; ?></h2>
                        </div>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="product-image">
                                 <a><img src="<?php echo $row['pimg']; ?>" alt="Image 1" style="width:200px;height:200px;"></a>
                                 <a><img src="<?php echo $row['pimg']; ?>" alt="Image 1" style="width:200px;height:200px;"></a>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                              <form action="" class="form-submit">
                                 <div class="product-price pt-2">
                                    <h4><b><ins><?php echo $row['catname']; ?></ins></b></h4>
                                 </div>
                                 <hr>
                                 <div class="product-price">
                                    <h5><b><ins>Discount : <?php echo $row['discount'] . '(%)'; ?></ins></b></h5>
                                 </div>
                                 <hr>
                                 <div class="form-group pt-2">
                                    <?php
                                    $query = "SELECT pgms FROM product WHERE id='$id'";
                                    $data = mysqli_query($con, $query);
                                    $count = 0;
                                    if (mysqli_num_rows($data) > 0) {
                                       while ($rows = mysqli_fetch_assoc($data)) {
                                    ?>
                                          <div class="fomr-group">
                                             <label for="cars">Quantity(GM/KG/PIECE/BOX)</label>
                                             <select name="pgms" class="form-control" id="ptype" onchange="priceChange(this.value);">
                                                <?php
                                                $values = explode('$;', $rows['pgms']);
                                                foreach ($values as $value) {
                                                ?>
                                                   <option class="ptype" value="<?php echo $count; ?>"><?php echo $value; ?></option>
                                                <?php
                                                   $count = $count + 1;
                                                }
                                                ?>
                                             </select>
                                             <input type="hidden" id="ppid" value="<?php echo $id; ?>">
                                          </div>
                                    <?php
                                       }
                                    }
                                    ?>
                                 </div>
                                 <div class="fomr-group">
                                    <label for="cars"><b>Price(BDT/=)</b></label>
                                    <select name="pprice" class="form-control" disabled id="fetchPriceonchange">
                                       <?php
                                       $cnt = 0;
                                       $query = "SELECT pprice FROM product WHERE id='$id'";
                                       $data = mysqli_query($con, $query);
                                       if (mysqli_num_rows($data) > 0) {
                                          while ($rows = mysqli_fetch_assoc($data)) {
                                       ?>
                                             <?php
                                             $values = explode('$;', $rows['pprice']);
                                             foreach ($values as $value) {
                                             ?>
                                                <option class="pprice" value="<?php echo $cnt; ?>"><?php echo $value; ?></option>
                                             <?php
                                                $cnt = $cnt + 1;
                                             }
                                             ?>

                                       <?php
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                                 <hr>
                                 <div class="form-group">
                                    <label for="cars"><b>Quantity(At least 1*)</b></label>
                                    <div class="input-group">
                                       <span class="input-group-btn">
                                          <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                             <span class="glyphicon glyphicon-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                          </button>
                                       </span>
                                       <input type="text" id="quantity" name="quantity" class="form-control qty" value="1" minlength="1" maxlength="10">
                                       <span class="input-group-btn">
                                          <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                             <span class="glyphicon glyphicon-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                          </button>
                                       </span>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="product-price">
                                    <h6><b><ins><?php echo $row['psdesc']; ?></ins></b></h6>
                                 </div>
                                 <hr>
                                 <div class="product-price font-primary">
                                    <input type="hidden" id="pid" value="<?php echo $_GET["id"]; ?>">
                                    <input type="hidden" class="pname" value="<?php echo $row['pname']; ?>">
                                    <input type="hidden" class="pimg" value="<?php echo $row['pimg']; ?>">
                                    <input type="hidden" class="discount" value="<?php echo $row['discount']; ?>">
                                    <button class="btn btn-block text-dark mt-1 addItemBtn" style="background-color: #28a745;"><b><i class="icon-shopping-cart"></i>&nbsp;Add to cart&nbsp;<i class="icon-shopping-cart"></i></b></button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
            <!---user password update area end--->
         </div>

         <!-- Related Product Section Start============================================= -->
         <div class="container">

            <div class="fancy-title title-dotted-border mt-4 mb-1 title-center">
               <h3>Related Products</h3>
            </div>
            <div id="oc-products" class="owl-carousel products-carousel carousel-widget" data-margin="20" data-loop="true" data-autoplay="5000" data-nav="true" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4" data-items-xl="5">
               <?php
               $cid = $_GET['cid'];
               $query = "SELECT * FROM product WHERE cid = '$cid'";
               $data = mysqli_query($con, $query);
               if (mysqli_num_rows($data) > 0) {
                  while ($row = mysqli_fetch_assoc($data)) {
               ?>
                     <div class="oc-item">
                        <div class="product iproduct clearfix">
                           <div class="product-image">
                              <a href="viewProduct.php?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>"><img src="<?php echo $row['pimg']; ?>" alt="Round Neck T-shirts" style="width:200px;height:200px;"></a>
                              <a href="viewProduct.php?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>"><img src="<?php echo $row['pimg']; ?>" alt="Round Neck T-shirts" style="width:200px;height:200px;"></a>
                               <div class="sale-flash" style="background-color: #FED700;color:black;">
                                  <?php
                                  if ($row['discount'] > 0) {
                                  ?>
                                     <span class="lead"><span class="badge badge-success" style="color:#fff;"><?php echo $row['discount'].' % Off' ?></span></span>
                                  <?php
                                  } else {
                                  ?>
                                     <span><span class="badge">Sale!</span></span>
                                  <?php
                                  }
                                  ?>
                               </div>
                              <div class="product-overlay" align="center">
                                 <?php
                                 if ($row['stock'] > 0) {
                                 ?>
                                    <a href="viewProduct.php?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>" class="add-to-cart">
                                       <i class="icon-shopping-cart"></i>
                                    </a>
                                 <?php
                                 } else {
                                 ?>
                                    <del><span style="color: #28a745;"><b> Out of stock</b></span></del>
                                 <?php
                                 }
                                 ?>
                              </div>
                           </div>
                           <div class="product-desc">
                              <div class="product-title mb-1">
                                 <h3>
                                    <center><a href="viewProduct.php?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>"><?php echo $row['pname']; ?></a></center>
                                 </h3>
                                 <a href="viewProduct.php?id=<?php echo $row["id"]; ?>&cid=<?php echo $row["cid"]; ?>" class="btn btn-block text-dark mt-1" style="background-color: #28a745;"><b><i class="icon-shopping-cart"></i>&nbsp;Add to cart&nbsp;<i class="icon-shopping-cart"></i></b></a>
                              </div>
                           </div>
                        </div>
                     </div>
               <?php
                  }
               }
               ?>
            </div>
         </div>
         <!-- Related Product Section End============================================= -->

         <div class="clear"></div>


         <!-- Last Section Area Start============================================= -->
         <?php
         require_once('includes/lastsection.php');
         ?>
         <!-- Last Section Area End============================================= -->

   </div>

   </section>
   <!-- #content end -->

   <!-- Footer Section Start============================================= -->
   <?php
   require_once('includes/footer.php');
   ?>
   <!-- Footer Section Start============================================= -->
   </div>
   <!-- #wrapper end -->

   <!-- Go To Top ============================================= -->
   <div id="gotoTop" class="icon-line-arrow-up"></div>
   <!-- Scripts Section Area Start============================================= -->
   <?php
   require_once('includes/scripts.php');
   ?>
   <!--- sweet alert popup area --->
   <?php
   if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
   ?>
      <script>
         swal.fire({
            position: 'top-end',
            icon: "<?php echo $_SESSION['status_code']; ?>",
            title: "<?php echo $_SESSION['status']; ?>",
            showConfirmButton: false,
            timer: 4000
         });
      </script>
   <?php
      unset($_SESSION['status']);
   }
   ?>
   <!--- sweet alert popup area end --->
   <!---Auto fetch price info--->
   <script type="text/javascript">
      function priceChange(Pricevalue) {
         ppid = $('#ppid').val();
         $.ajax({

            url: 'priceinfofetch.php',
            type: 'POST',
            data: {
               Pricepost: Pricevalue,
               ppid: ppid,
            },
            success: function(result) {
               $('#fetchPriceonchange').html(result);
            }

         });
      }
   </script>
   <!---Auto fetch price info--->
   <!--additional scripts area start--->
   <!--- add item to cart area start---->
   <script type="text/javascript">
      $(document).ready(function() {
         $(".addItemBtn").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find("#pid").val();
            var pname = $form.find(".pname").val();
            var pimg = $form.find(".pimg").val();
            var ptype = $form.find("#ptype").val();
            var pprice = $form.find("#fetchPriceonchange").val();
            var discount = $form.find(".discount").val();
            var qty = $form.find(".qty").val();

            $.ajax({
               url: 'action.php',
               method: 'post',
               data: {
                  pid: pid,
                  pname: pname,
                  pimg: pimg,
                  ptype: ptype,
                  pprice: pprice,
                  discount: discount,
                  qty: qty
               },
               success: function(response) {
                  $("#message").html(response);
                  load_cart_item_number();
               }
            });
         });

         //cart icon value update
         load_cart_item_number();

         function load_cart_item_number() {
            $.ajax({
               url: 'action.php',
               method: 'get',
               data: {
                  cartItem: "cart_item"
               },
               success: function(response) {
                  $("#cart-item").html(response);
               }
            });
         }
      });
   </script>
   <!--- add item to cart area end---->
   <!-- plus minus button control for quantity--->
   <script>
      $(document).ready(function() {

         var quantitiy = 0;
         $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

         });

         $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 1) {
               $('#quantity').val(quantity - 1);
            }
         });

      });
   </script>
   <!-- plus minus button control for quantity--->
   <!--additional scripts area start--->
   <!-- Scripts Section Area End============================================= -->
</body>

</html>