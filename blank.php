<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
   <!-- Stylesheets/CDN Area Start ============================================= -->
   <?php
   $page = 'index';
   require_once('includes/cdn.php');
   ?>
   <!-- Stylesheets/CDN Area End ============================================= -->
</head>

<body class="stretched">
   <!-- Document Wrapper ============================================= -->
   <div id="wrapper" class="clearfix">

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

      <!--Banner Slider area start ============================================= -->
      <?php
      require_once('includes/mainslider.php');
      ?>
      <!-- Banner Slider area End -->

      <div class="container">
         <?php
         $query = "SELECT pgms FROM product WHERE id='57'";
         $data = mysqli_query($con, $query);
         $count = 0;
         if (mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {
         ?>
               <div class="fomr-group">

                  <label for="cars">Choose a quantity:</label>

                  <select name="pgms" class="form-control" onchange="priceChange(this.value);">
                     <?php
                     $values = explode('$;', $row['pgms']);
                     foreach ($values as $value) {
                     ?>
                        <option value="<?php echo $count; ?>"><?php echo $value; ?></option>
                     <?php
                        $count = $count + 1;
                     }
                     ?>
                  </select>
               </div>
         <?php
            }
         }
         ?>
      </div>

      <div class="container">
         <div class="fomr-group">
            <label for="cars">Choose a Price:</label>
            <select name="pprice" class="form-control" id="fetchPriceonchange">
               <?php
               $cnt = 0;
               $query = "SELECT pprice FROM product WHERE id='57'";
               $data = mysqli_query($con, $query);
               if (mysqli_num_rows($data) > 0) {
                  while ($row = mysqli_fetch_assoc($data)) {
               ?>

                     <?php
                     $values = explode('$;', $row['pprice']);
                     foreach ($values as $value) {
                     ?>
                        <option value="<?php echo $cnt; ?>"><?php echo $value; ?></option>
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
      </div>

      <!-- Content ============================================= -->
      <section id="content">
         <div class="content-wrap">
            <div class="container clearfix">
               <!-- Popular Categories Area Start ============================================= -->
               <?php
               require_once('includes/popularCatagories.php');
               ?>
               <!-- Popular Categories Area End ============================================= -->

               <!-- Popular Product Carousel Start============================================= -->
               <?php
               require_once('includes/popularproductslider.php');
               ?>
               <!-- Popular Product Carousel End============================================= -->
            </div>


            <div class="clear"></div>

            <div class="container clearfix">

               <!-- Randomize Products Section Start============================================= -->
               <?php
               require_once('includes/randomizeProducts.php');
               ?>
               <!-- Randomize Products Section End============================================= -->

            </div>



            <!-- Sign Up / Banner area Start============================================= -->
            <?php
            require_once('includes/signUpbanner.php');
            ?>
            <!-- Sign Up / Banner area End============================================= -->

            <div class="clear"></div>

            <div class="container clearfix">
               <!-- All Catagories List Area Start============================================= -->
               <?php
               require_once('includes/allCatagorieslist.php');
               ?>
               <!-- All Catagories List Area End============================================= -->
            </div>

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
   <!---Auto fetch price info--->
   <script type="text/javascript">
      function priceChange(Pricevalue) {
         $.ajax({

            url: 'priceinfofetch.php',
            type: 'POST',
            data: {
               Pricepost: Pricevalue
            },
            success: function(result) {
               $('#fetchPriceonchange').html(result);
            }

         });
      }
   </script>
   <!---Auto fetch price info--->
   <!-- Scripts Section Area End============================================= -->
</body>

</html>