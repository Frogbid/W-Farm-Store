<div class="fancy-title title-dotted-border title-center mb-4">
   <center>
      <h4>All Catagories</h4>
   </center>
</div>
<div class="row mt-5 clearfix">
   <?php
   $query = "SELECT * FROM category";
   $data = mysqli_query($con, $query);
   if (mysqli_num_rows($data) > 0) {
      while ($row = mysqli_fetch_assoc($data)) {
   ?>
         <div class="col-lg-2 col-md-2col-sm-12 col-12">
            <a href="Catagory?id=<?php echo $row["id"]; ?>"><img src="<?php echo $row['catimg']; ?>" alt="Clients"></a>
            <center><i><b><?php echo $row['catname']; ?></b></i></center>
         </div>
   <?php
      }
   }
   ?>
</div>