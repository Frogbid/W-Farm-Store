<header id="header" class="full-header clearfix">

      <div id="header-wrap">

            <div class="container clearfix">

                  <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                  <!-- Logo
					============================================= -->
                  <div id="logo">
                        <a href="Homepage" class="standard-logo">Farm Store</a>
                        <a href="Homepage" class="retina-logo">Farm Store</a>
                  </div><!-- #logo end -->

                  <!-- Primary Navigation
					============================================= -->
                  <nav id="primary-menu" class="style-2 with-arrows">

                        <ul>
                              <li class="current"><a href="Homepage">
                                          <div>Home</div>
                                    </a></li>
                              <!-- Mega Menu
							============================================= -->
                              <li class="mega-menu"><a href="#">
                                          <div>Catagories</div>
                                    </a>
                                    <div class="mega-menu-content style-2 clearfix">

                                          <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                                <?php
                                                $query = "SELECT * FROM category";
                                                $data = mysqli_query($con, $query);
                                                if (mysqli_num_rows($data) > 0) {
                                                      while ($row = mysqli_fetch_assoc($data)) {
                                                ?>
                                                            <ul class="mega-menu-column border-left-0 col-lg-3">
                                                                  <li class="nav-item">
                                                                       <p> <img src="<?php echo $row['catimg']; ?>" style="width:20px;height:20px;" >&nbsp;<a href="Catagory?id=<?php echo $row["id"]; ?>"><?php echo $row['catname']; ?></a></p>
                                                                  </li>
                                                            </ul>
                                                <?php
                                                      }
                                                }
                                                ?>

                                          </div>
                                          <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                <ul class="mega-menu-column border-left-0">
                                                      <li class="card p-0 nobg noborder">
                                                            <img class="card-img-top" src="images/4.jpg" alt="image cap">
                                                      </li>
                                                </ul>
                                          </div>
                                    </div>
                              </li><!-- .mega-menu end -->
                              <!--mobile menu cart --->
                              <?php
                              if (!isset($_SESSION['id'])) {
                              ?>
                                    <li>
                                          <a>
                                                <div>Cart(0)</div>
                                          </a>
                                    </li>
                              <?php
                              } else {
                              ?>
                                    <?php
                                    $id = $_SESSION['id'];
                                    $query = ("SELECT * FROM cart_table WHERE uid = '$id'");
                                    $data = mysqli_query($con, $query);
                                    $total = mysqli_num_rows($data);
                                    ?>
                                    <li>
                                          <a href="Cart">
                                                Cart
                                          </a>
                                    </li>
                              <?php
                              }
                              ?>
                              <!--mobile menu cart --->

                              <?php
                              if (!isset($_SESSION['id'])) {
                              ?>
                                    <li>
                                          <a href="Login">
                                                <div><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>Login</div>
                                          </a>
                                    </li>
                              <?php
                              } else {
                              ?>
                                    <li class="nav-item dropdown" style="list-style: none;">
                                          <a class="nav-link dropdown-toggle position-relative" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>
                                                Welcome
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="TrackOrder">Track Orders</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="Profile">Profile</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="BilligAddress">Address</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="ChangePassword">Settings</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="logout.php">Logout</a>
                                          </div>
                                    </li>
                              <?php
                              }
                              ?>

                        </ul>
                        <!-- Top Cart ============================================= -->
                        <?php
                        if (!isset($_SESSION['id'])) {
                        ?>
                              <div id="top-cart">
                                    <a><i class="icon-line-bag"></i><span>0</span></a>
                              </div>
                        <?php
                        } else {
                        ?>
                              <?php
                              $id = $_SESSION['id'];
                              $query = ("SELECT * FROM cart_table WHERE uid = '$id'");
                              $data = mysqli_query($con, $query);
                              $total = mysqli_num_rows($data);
                              ?>

                              <div id="top-cart">
                                    <a href="Cart"><i class="icon-line-bag"></i><span class="text-white" id="cart-item"><?php echo $total; ?></span></a>
                              </div>
                        <?php
                        }
                        ?>
                        <!-- #top-cart end -->
                  </nav>
            </div>
      </div>
</header>