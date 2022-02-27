<div class="fancy-title title-dotted-border title-center mb-4">
   <h4>Popular categories</h4>
</div>

<div class="row shop-categories clearfix">
   <?php
   $query = "SELECT * FROM category ORDER BY RAND() LIMIT 6 ";
   $data = mysqli_query($con, $query);
   if (mysqli_num_rows($data) > 0) {
      while ($row = mysqli_fetch_assoc($data)) {
   ?>
         <div class="col-lg-4">
            <a href="Catagory?id=<?php echo $row["id"]; ?>" style="background: url('<?php echo $row['catimg']; ?>') no-repeat center center; background-size: cover;">
               <div class="vertical-middle dark center">
                  <div class="heading-block nomargin noborder">
                     <h3 class="nott t600 ls0"><?php echo $row['catname']; ?></h3>
                  </div>
               </div>
            </a>
         </div>
   <?php
      }
   }
   ?>
</div>